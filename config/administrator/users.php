<?php


return array(
    'title' => 'Users',
    'single' => 'user',
    'model' => 'User',
    /**
     * The display columns
     */
    'columns' => array(
        'id',
    ),
    /**
     * The editable fields
     */
    'edit_fields' => array(
        'email' => array(
            'title' => 'Email',
            'type' => 'text',
        ),
    ),
);