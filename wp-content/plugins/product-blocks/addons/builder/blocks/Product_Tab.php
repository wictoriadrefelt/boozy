<?php
namespace WOPB\blocks;

defined('ABSPATH') || exit;

class Product_Tab{

    public function __construct() {
        add_action('init', array($this, 'register'));
    }

    public function get_attributes($default = false){

        $attributes = array(
            'blockId' => [
                'type' => 'string',
                'default' => '',
            ],
            'hideDescription' => [
                'type' => 'boolean',
                'default' => false
            ],
            'hideAddInfo' => [
                'type' => 'boolean',
                'default' => false
            ],
            'hideReview' => [
                'type' => 'boolean',
                'default' => false
            ],
            //--------------------------
            //  navigation style
            //--------------------------
            'navDevider' => [
                'type'=> 'string',
                'default' => '',
            ],
            'navTypo'=>[
                'type' => 'object',
                'default' =>  (object)['openTypography' => 0,'size' => (object)['lg' => '18', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => '', 'transform' => '', 'family'=>'','weight'=>''],
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .woocommerce-tabs ul li > a'
                    ],
                ],
            ],
            'navtextColor' => [
                'type' => 'string',
                'default' => '',
                'style' =>[
                    (object)[
                        'selector'=>'.woocommerce {{WOPB}} div.product .woocommerce-tabs ul.tabs li a, {{WOPB}} div.product .woocommerce-tabs ul.tabs li a{color:{{navtextColor}}}',
                    ],
                ],
            ],
            'navbgcolor' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                     (object)[
                        'selector'=>'.woocommerce {{WOPB}} div.product .woocommerce-tabs ul.tabs li a, {{WOPB}} div.product .woocommerce-tabs ul.tabs li a {background:{{navbgcolor}};}'
                    ],
                ],
            ],
            'navhoverBgColor' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                     (object)[
                        'selector'=>'.woocommerce {{WOPB}} div.product .woocommerce-tabs ul.tabs li a:hover, {{WOPB}} div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce {{WOPB}} div.product .woocommerce-tabs ul.tabs li.active a, div.product .woocommerce-tabs ul.tabs li.active a {background-color:{{navhoverBgColor}};}'
                    ],
                ],
            ],
            'navpadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['unit' =>'px']],
                'style' => [
                    (object)[
                       'selector'=>'.woocommerce {{WOPB}} div.product .woocommerce-tabs ul.tabs li a, {{WOPB}} div.product .woocommerce-tabs ul.tabs li a, .editor-styles-wrapper {{WOPB}} .woocommerce div.product .woocommerce-tabs ul.tabs li a{padding:{{navpadding}}}'
                   ],
               ],
            ],

            //--------------------------
            //  description Settings
            //--------------------------
            'showDesc'=>[
                'type' => 'boolean',
                'default'=> true,
                'style' =>[
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDesc','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .woocommerce-Tabs-panel--description{display:block;}'
                    ],
                ],
                
            ],
            'descText' => [
                'type' => 'string',
                'default' => 'Description',
                'style' =>[
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDesc','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .woocommerce-Tabs-panel--description{display:block;}'
                    ],
                ],
            ],
            'descHeadingColor' => [
                'type' => 'string',
                'default' => ' ',
                'style' =>[
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDesc','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .woocommerce-Tabs-panel--description > h2{color:{{descHeadingColor}};}'
                    ],
                ],
            ],
            'descColor' => [
                'type' => 'string',
                'default' => '',
                'style' =>[
                    (object)[
                        'selector'=>' {{WOPB}} .woocommerce-Tabs-panel--description >  p{color:{{descColor}};}'
                    ],
                ],
            ],
            'descHeadingTypo'=>[
                'type' => 'object',
                'default' =>  (object)['openTypography' => 0,'size' => (object)['lg' => '', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => '', 'transform' => '', 'family'=>'','weight'=>''],
                'style' =>[
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDesc','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .woocommerce-Tabs-panel--description > h2'
                    ],
                ],
            ],
            'descTypo'=>[
                'type' => 'object',
                'default' =>  (object)['openTypography' => 0,'size' => (object)['lg' => '', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => '', 'transform' => '', 'family'=>'','weight'=>''],
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .woocommerce-Tabs-panel--description > p'
                    ],
                ],
            ],
            // 'descDevider' => [
            //     'type'=> 'string',
            //     'default' => '',
            // ],
            // 'desHeadSpace' => [
            //     'type' => 'string',
            //     'default' => '',
            //     'style' =>[
            //         (object)[
            //             'selector'=>'{{WOPB}} .woocommerce-Tabs-panel--description > h2{margin-bottom:{{desHeadSpace}}px}'
            //         ],
            //     ],
            // ],
            //--------------------------
            //  Additional Info
            //--------------------------
            // title style
            'showAddInfoHeading'=> [
                'type' => 'boolean',
                'default'=> true,
                'style' =>[
                    (object)[
                        'depends' => [
                            (object)['key'=>'showAddInfoHeading','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .woocommerce-Tabs-panel--additional_information > h2{display:block;}'
                    ],
                ],
            ],
            'infoPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)[ 'unit' =>'px']],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .woocommerce-product-attributes tr td, {{WOPB}} .woocommerce-product-attributes tr th{ padding:{{infoPadding}};}'
                    ],
                ],
            ],
            'headingText' => [
                'type' => 'string',
                'default' => 'Product Tab',
                'style' =>[
                    (object)[
                        'depends' => [
                            (object)['key'=>'showAddInfoHeading','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .woocommerce-Tabs-panel--additional_information{display:block;}'
                    ],
                ],
            ],
            'headingColor' => [
                'type' => 'string',
                'default' => '',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}}  .woocommerce-Tabs-panel--additional_information  > h2{color:{{headingColor}};}'
                    ]
                ],
            ],
            'HeadingTypo'=>[
                'type' => 'object',
                'default' =>  (object)['openTypography' => 0,'size' => (object)['lg' => '', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => '', 'transform' => '', 'family'=>'','weight'=>''],
                'style' =>[
                    (object)[
                        'depends' => [
                            (object)['key'=>'showAddInfoHeading','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .woocommerce-Tabs-panel--additional_information > h2'
                    ],
                    
                ],
            ],

            // label style
            'labelTypo'=>[
                'type' => 'object',
                'default' =>  (object)['openTypography' => 0,'size' => (object)['lg' => '', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => '', 'transform' => '', 'family'=>'','weight'=>''],
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .woocommerce-product-attributes-item__label'
                    ],
                ],
            ],
            'labelColor' => [
                'type' => 'string',
                'default' => '',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .woocommerce-product-attributes-item__label {color:{{labelColor}};}'
                    ]
                ],
            ],
            'labelBg' => [
                'type' => 'string',
                'default' => '',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .woocommerce-product-attributes-item__label , .woocommerce table.shop_attributes tr:nth-child(even) th ,.woocommerce table.shop_attributes tr > th{background:{{labelBg}};}'
                    ]
                ],
            ],
            // additional value
            'addInfoValueBg' => [
                'type' => 'string',
                'default' => ' ',
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .woocommerce-product-attributes-item__value , .woocommerce table.shop_attributes tr:nth-child(even) td ,.editor-styles-wrapper table:not( .has-background ) tbody tr:nth-child(2n) td , .woocommerce table.shop_attributes tr > td{background:{{addInfoValueBg}};}',
                    ],
                ],
            ],
            'addInoValueColor' => [
                'type' => 'string',
                'default' => '',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .woocommerce-product-attributes-item__value > p{color:{{addInoValueColor}};}'
                    ]
                ],
            ],
            'addInfoValueTypo'=>[
                'type' => 'object',
                'default' =>  (object)['openTypography' => 0,'size' => (object)['lg' => '', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => '', 'transform' => '', 'family'=>'','weight'=>''],
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .woocommerce-product-attributes-item__value > p'
                    ],
                    
                ],
            ],
            //--------------------------
            //  Review
            //--------------------------
            'reviewHeading'=>[
                'type' => 'boolean',
                'default'=> true,
                'style' =>[
                    (object)[
                        'depends' => [
                            (object)['key'=>'reviewHeading','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .woocommerce-Reviews-title {display:block}'
                    ],
                ],
            ],
            'reviewAuthor'=>[
                'type' => 'boolean',
                'default'=> false,
                'style' =>[
                    (object)[
                        'depends' => [
                            (object)['key'=>'reviewAuthor','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .comment_container > img {display:none;}  {{WOPB}}  .woocommerce #reviews #comments ol.commentlist li .comment-text{margin:0px 0px 0px 0px}'
                    ],
                ],
            ],
            'reviewHeadinglColor' => [
                'type' => 'string',
                'value' => ' ',
                'style' =>[
                    (object)[
                        'depends' => [
                            (object)['key'=>'reviewHeading','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}}   .woocommerce-Reviews-title ,  .edit-post-visual-editor .block-editor-block-list__block .woocommerce-Reviews h2{color:{{reviewHeadinglColor}};}'
                    ]
                ],
            ],
            'headingTypography'=>[
                'type' => 'object',
                'default' =>  (object)['openTypography' => 0,'size' => (object)['lg' => '', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => '', 'transform' => '', 'family'=>'','weight'=>''],
                'style' =>[
                    (object)[
                        'depends' => [
                            (object)['key'=>'reviewHeading','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .woocommerce-Reviews-title'
                    ],
                ],
            ],

            // Review Style
            'reviewColor' => [
                'type' => 'string',
                'value' => ' ',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .description > p, {{WOPB}} .woocommerce-review__author, {{WOPB}} .woocommerce-review__dash, {{WOPB}} .woocommerce-review__published-date {color:{{reviewColor}};}'
                    ]
                ],
            ],
            'reviewStarColor' => [
                'type' => 'string',
                'value' => '',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}}  .star-rating span::before, {{WOPB}} #reviews p.stars a::before{color:{{reviewStarColor}};}'
                    ]
                ],
            ],
            'reviewEmptyColor' => [
                'type' => 'string',
                'value' => '',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}}  .star-rating::before{color:{{reviewEmptyColor}};}'
                    ]
                ],
            ],
            'authorTypography'=>[
                'type' => 'object',
                'default' =>  (object)['openTypography' => 0,'size' => (object)['lg' => '', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => '', 'transform' => '', 'family'=>'','weight'=>''],
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .woocommerce-review__author'
                    ],
                ],
            ],
            'dateTypography'=>[
                'type' => 'object',
                'default' =>  (object)['openTypography' => 0,'size' => (object)['lg' => '', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => '', 'transform' => '', 'family'=>'','weight'=>''],
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} #reviews .commentlist li time'
                    ],
                ],
            ],
            'descTypography'=>[
                'type' => 'object',
                'default' =>  (object)['openTypography' => 0,'size' => (object)['lg' => '', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => '', 'transform' => '', 'family'=>'','weight'=>''],
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .description > p'
                    ],
                ],
            ],
            'authorSize' => [
                'type' => 'string',
                'default' => '',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} #reviews #comments .commentlist li img.avatar, .woocommerce {{WOPB}} #reviews #comments .commentlist li img.avatar , .woocommerce #reviews #comments ol.commentlist li img.avatar{width:{{authorSize}}px;}'
                    ]
                ]
            ],
            // review Form lebel
            'reviewFormLabelColor' => [
                'type' => 'string',
                'value' => '',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} #reviews .comment-form-rating label, {{WOPB}} #respond .comment-form-comment label {color:{{reviewFormLabelColor}};}'
                    ]
                ],
            ],
            'reviewFormRequiredColor' => [
                'type' => 'string',
                'value' => '',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} #reviews .comment-form-rating label .required, {{WOPB}} #respond .comment-form-comment label .required {color:{{reviewFormRequiredColor}};}'
                    ]
                ],
            ],
            'reviewFormLabelTypo'=>[
                'type' => 'object',
                'default' =>  (object)['openTypography' => 0,'size' => (object)['lg' => '', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => '', 'transform' => '', 'family'=>'','weight'=>''],
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} #reviews .comment-form-rating label, {{WOPB}} #respond .comment-form-comment label'
                    ],
                ],
            ],

            // review form input
            'reviewFormInputColor' => [
                'type' => 'string',
                'value' => '',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} #respond .comment-form-comment textarea {color:{{reviewFormInputColor}};}'
                    ]
                ],
            ],
            'reviewFormInputBorderColor' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} #respond .comment-form-comment textarea{border-color:{{reviewFormInputBorderColor}}}'
                    ]
                ],
            ],
            'reviewFormInputFocusColor' => [
                'type' => 'string',
                'value' => '',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} #respond .comment-form-comment textarea:focus{border-color:{{reviewFormInputFocusColor}};box-shadow:none;}'
                    ]
                ],
            ],
            'reviewFormInputTypo'=>[
                'type' => 'object',
                'default' =>  (object)['openTypography' => 0,'size' => (object)['lg' => '', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => '', 'transform' => '', 'family'=>'','weight'=>''],
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} #respond .comment-form-comment textarea'
                    ],
                ],
            ],
            'reviewFormSpace' => [
                'type' => 'string',
                'default' => '',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} #respond .comment-form-comment textarea {margin-top:{{reviewFormSpace}}px;}'
                    ]
                ]
            ],
            'reviewFormRadius' => [
                'type' => 'string',
                'default' => '',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} #respond .comment-form-comment textarea {border-radius:{{reviewFormRadius}}px;}'
                    ]
                ]
            ],
            'reviewFormInputPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['unit' =>'px']],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} #respond .comment-form-comment textarea {padding:{{reviewFormInputPadding}};}'
                    ],
                ],
            ],
            // button style 
            'btnTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography' => 0, 'size' => (object)['lg' =>'', 'unit' =>'px'], 'height' => (object)['lg' =>'', 'unit' =>'px'], 'spacing' => (object)['lg' =>0, 'unit' =>'px'], 'transform' => '', 'weight' => '', 'decoration' => '','family'=>'' ],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .form-submit input[type="submit"] ,.woocommerce #respond input#submit'
                    ],
                ],
            ],
            'btnColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .form-submit input[type="submit"] ,.woocommerce #respond input#submit {color:{{btnColor}};}'
                    ],
                ],
            ],
            'btnBgColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1,'type' => 'color', 'color' => '#ff5845'],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .form-submit input[type="submit"] , .woocommerce #respond input#submit'
                    ],
                ],
            ],
            'btnBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .form-submit input[type="submit"] , .woocommerce #respond input#submit'
                    ],
                ],
            ],
            'btnRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'2', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .form-submit input[type="submit"] , .woocommerce #respond input#submit { border-radius:{{btnRadius}};}'
                    ],
                ],
            ],
            'btnShadow' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .form-submit input[type="submit"] , .woocommerce #respond input#submit'
                    ]
                    ],
             ],
            'btnPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => "6",'bottom' => "6",'left' => "12",'right' => "12", 'unit' =>'px']],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}}  .form-submit input[type="submit"] ,.woocommerce #respond input#submit{padding:{{btnPadding}};}'
                    ],
                ],
            ],
            'btnSpacing' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => "6",'bottom' => "6",'left' => "12",'right' => "12", 'unit' =>'px']],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}}  .form-submit input[type="submit"] , .woocommerce #respond input#submit {margin:{{btnSpacing}};}'
                    ],
                ],
            ],
            'btnHoverColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}}  .form-submit input[type="submit"]:hover , .woocommerce #respond input#submit:hover { color:{{btnHoverColor}}; }'
                    ],
                ],
            ],
            'btnBgHoverColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1,'type' => 'color', 'color' => '#1239e2'],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .form-submit input[type="submit"]:hover , .woocommerce #respond input#submit:hover'
                    ],
                ],
            ],
            'btnHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .form-submit input[type="submit"]:hover , .woocommerce #respond input#submit:hover'
                    ],
                ],
            ],
            'btnHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .form-submit input[type="submit"]:hover , .woocommerce #respond input#submit:hover{ border-radius:{{btnHoverRadius}}; }'
                    ],
                ],
            ],
            'btnHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .form-submit input[type="submit"]:hover , .woocommerce #respond input#submit:hover'
                    ],
                ],
            ],
            

            //--------------------------
            //  Wrap Settings
            //--------------------------
            'wrapBg' => [
                'type' => 'string',
                'default' => (object)['openColor' => 0, 'type' => 'color', 'color' => '#f5f5f5'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper'
                    ],
                ],
            ],
            'wrapBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' =>(object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper'
                    ],
                ],
            ],
            'wrapShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper'
                    ],
                ],
            ],
            'wrapRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper{ border-radius:{{wrapRadius}}; }'
                    ],
                ],
            ],
            'wrapHoverBackground' => [
                'type' => 'object',
                'default' => (object)['openColor' => 0, 'type' => 'color', 'color' => '#ff5845'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper:hover'
                    ],
                ],
            ],
            'wrapHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper:hover'
                    ],
                ],
            ],
            'wrapHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper:hover { border-radius:{{wrapHoverRadius}}; }'
                    ],
                ],
            ],
            'wrapHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper:hover'
                    ],
                ],
            ],
            'wrapMargin' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '', 'unit' =>'px']],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper{ margin:{{wrapMargin}}; }'
                    ],
                ],
            ],
            'wrapOuterPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '','left' => '', 'right' => '', 'unit' =>'px']],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper{ padding:{{wrapOuterPadding}}; }'
                    ],
                ],
            ],
            'advanceId' => [
                'type' => 'string',
                'default' => '',
            ],
            'advanceZindex' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'selector' => '{{WOPB}} {z-index:{{advanceZindex}};}'
                    ],
                ],
            ],
            'hideExtraLarge' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'selector' => '{{WOPB}} {display:none;}'
                    ],
                ],
            ],
            'hideDesktop' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'selector' => '{{WOPB}} {display:none;}'
                    ],
                ],
            ],
            'hideTablet' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'selector' => '{{WOPB}} {display:none;}'
                    ],
                ],
            ],
            'hideMobile' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'selector' => '{{WOPB}} {display:none;}'
                    ],
                ],
            ],
            'advanceCss' => [
                'type' => 'string',
                'default' => '',
                'style' => [(object)['selector' => '']],
            ]
        );
        
        if( $default ){
            $temp = array();
            foreach ($attributes as $key => $value) {
                if( isset($value['default']) ){
                    $temp[$key] = $value['default'];
                }
            }
            return $temp;
        }else{
            return $attributes;
        }
    }

    public function register() {
        register_block_type( 'product-blocks/product-tab',
            array(
                'title' => __('Product Tab', 'product-blocks'),
                'attributes' => $this->get_attributes(),
                'render_callback' =>  array($this, 'content')
            ));
    }

    public function content($attr) {
        global $product;
        $block_name = 'product-tab';
        $wraper_before = $wraper_after = $content = '';
        
        $product = wc_get_product();

        if (!empty($product)) {

            global $productx_tab;
            $productx_tab['desc'] = $attr['hideDescription'];
            $productx_tab['info'] = $attr['hideAddInfo'];
            $productx_tab['review'] = $attr['hideReview'];
            $hide_description = function( $tabs ) {
                global $productx_tab;
                if ($productx_tab['desc']) {
                    unset( $tabs['description'] );
                }
                if ($productx_tab['info']) {
                    unset( $tabs['additional_information'] );
                }
                if ($productx_tab['review']) {
                    unset( $tabs['reviews'] );
                }
                return $tabs;
            };

            $productx_tab['add_heading'] = $attr['showAddInfoHeading'];
            $productx_tab['add_text'] = $attr['headingText'];
            $additional_heading = function() {
                global $productx_tab;
                return $productx_tab['add_heading'] ? $productx_tab['add_text'] : '';
            };

            $productx_tab['desc_heading'] = $attr['showDesc'];
            $productx_tab['desc_text'] = $attr['descText'];
            $description_heading = function() {
                global $productx_tab;
                return $productx_tab['desc_heading'] ? $productx_tab['desc_text'] : '';
            };
            
            $wraper_before .= '<div '.($attr['advanceId']?'id="'.$attr['advanceId'].'" ':'').' class="wp-block-product-blocks-'.$block_name.' wopb-block-'.$attr["blockId"].' '.(isset($attr["className"])?$attr["className"]:'').'">';
            $wraper_before .= '<div class="wopb-product-wrapper">';
            $wraper_before .= '<div class="product">';

            add_filter( 'woocommerce_product_tabs', $hide_description );
            add_filter( 'woocommerce_product_additional_information_heading', $additional_heading );
            add_filter( 'woocommerce_product_description_heading', $description_heading );

            ob_start();
            woocommerce_output_product_data_tabs();
            $content .= ob_get_clean();
            
            remove_filter( 'woocommerce_product_tabs', $hide_description );
            remove_filter( 'woocommerce_product_additional_information_heading', $additional_heading );
            remove_filter( 'woocommerce_product_description_heading', $description_heading );
            $wraper_after .= '</div>';
            $wraper_after .= '</div>';
            $wraper_after .= '</div>';
        }

        return $wraper_before.$content.$wraper_after;
    }

}