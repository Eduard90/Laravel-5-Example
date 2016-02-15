<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Product;

use Sunra\PhpSimple\HtmlDomParser;

class ImportYM extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import_ym {xml : Path to xml file} {limit : Limit for import}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function request($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url ); // отправляем на
//        curl_setopt($ch, CURLOPT_HEADER, 0); // пустые заголовки
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // возвратить то что вернул сервер

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // следовать за редиректами
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);// таймаут4
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__).'/cookie.txt'); // сохранять куки в файл
        curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__).'/cookie.txt');
        curl_setopt($ch,CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.73 Chrome/47.0.2526.73 Safari/537.36');
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * Обработка xml файла и сохранение путей до картинок товаров
     *
     * @return mixed
     */
    public function handle()
    {
        $ym_link = "http://market.yandex.ru";
        $xml_path = $this->argument('xml');
        $limit = $this->argument('limit');

        if (file_exists($xml_path)) {
            $this->info('Start import from xml...');
            $xml_obj = simplexml_load_file($xml_path);
            $count = count($xml_obj);
            $i = 0;
            foreach($xml_obj as $key => $obj) {
                $i++;

                if ($i > $limit) {
                    continue;
                }

                if ($obj->title) {
                    $this->info("Import " . $i . "/" . $count . " '" . $obj->title . "'");
                    $title = $obj->title;
                    $ym_id = $obj->attributes()->id;
                    $product = Product::where('ym_id', '=', $ym_id)->first();
                    if ($product) {
                        $this->info('Duplicate!');
                        continue;
                    }

                    $url = $ym_link . $obj->url;
                    $this->info($url);
                    $data = $this->request($url);

                    $html = HtmlDomParser::str_get_html($data);
                    $images = $html->find('.product-card-gallery__image-container > img');
                    if (count($images) == 1) {
                        $this->info('All right. We found image.');
                        $image = $images[0];
                        $image_src = $image->src;
                        $image_src = str_replace('//mdata.', 'http://mdata.', $image_src);

                        if (!$product) {
                            $product = Product::create(['title' => $title, 'ym_id' => $ym_id, 'ym_url' => $url, 'image_url' => $image_src]);
                            $this->info('Saved!');
                        }
                    }
                }
            }
        }
    }
}
