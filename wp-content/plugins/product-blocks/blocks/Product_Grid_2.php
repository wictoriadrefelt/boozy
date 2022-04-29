<?php
namespace WOPB\blocks;

defined('ABSPATH') || exit;

class Product_Grid_2{

    public function __construct() {
        add_action('init', array($this, 'register'));
    }

    public function get_attributes($default = false){

        $attributes = array(
            'blockId' => [
                'type' => 'string',
                'default' => '',
            ],

            //--------------------------
            //      Layout Setting
            //--------------------------
            'layout' => [
                'type' => 'string',
                'default' => '1',
            ],
            'productView' => [
                'type' => 'string',
                'default' => 'grid',
            ],
            'columns' => [
                'type' => 'object',
                'default' => (object)['lg' =>'4','md' =>'3','sm' =>'2','xs'=>'2'],
                'style' => [
                    (object)[
                         'depends' => [
                             (object)['key'=>'productView','condition'=>'==','value'=>'grid'],
                         ],
                        'selector'=>'{{WOPB}} .wopb-block-items-wrap { grid-template-columns: repeat({{columns}}, 1fr); }'
                    ],
                ],

            ],
            'columnGridGap' => [
                'type' => 'object',
                'default' => (object)['lg' =>'30', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'productView','condition'=>'==','value'=>'grid'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-items-wrap { grid-column-gap: {{columnGridGap}}; }'
                    ],
                ],
            ],

            'rowGap' => [
                'type' => 'object',
                'default' => (object)['lg' =>'30', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'productView','condition'=>'==','value'=>'grid'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-items-wrap { grid-row-gap: {{rowGap}}; }'
                    ],
                ],
            ],
            'columnGap' => [
                'type' => 'object',
                'default' => (object)['lg' =>'10', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'productView','condition'=>'==','value'=>'slide'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-blocks-slide .wopb-block-item { padding: {{columnGap}}; }'
                    ],
                ],
            ],
            'slidesToShow' => [
                'type' => 'object',
                'default' => (object)['lg' =>'4', 'md' =>'3', 'sm' => '2', 'xs' => '1'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'productView','condition'=>'==','value'=>'slide'],
                        ],
                    ],
                ],
            ],
            'autoPlay' => [
               'type' => 'boolean',
                'default' => true,
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'productView','condition'=>'==','value'=>'slide'],
                        ],
                    ],
                ],
            ],
            'showDots' => [
               'type' => 'boolean',
                'default' => true,
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'productView','condition'=>'==','value'=>'slide'],
                        ],
                    ],
                ],
            ],
            'showArrows' => [
                'type' => 'boolean',
                'default' => true,
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'productView','condition'=>'==','value'=>'slide'],
                        ],
                    ],
                ],
            ],
            'slideSpeed' => [
                'type' => 'string',
                'default' => '3000',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'productView','condition'=>'==','value'=>'slide'],
                        ],
                    ],
                ],
            ],


            //--------------------------
            //      General Setting
            //--------------------------
            'showPrice' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'showReview' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'showCart' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'showOutStock' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'showInStock' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'showShortDesc' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'showSale' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'showHot' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'showDeal' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'showWishList' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'showCompare' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'quickView' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'filterShow' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'headingShow' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'paginationShow' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'catShow' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'titleShow' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'showImage' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'showFlip' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'showImage','condition'=>'==','value'=>true],
                        ],
                    ],
                ]
            ],
            'contentAlign' => [
                'type' => 'string',
                'default' => "center",
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'contentAlign','condition'=>'==','value'=>'left'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-content-wrap { text-align:{{contentAlign}}; } {{WOPB}} .wopb-grid3-quick-cart {justify-content: flex-start;}'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'contentAlign','condition'=>'==','value'=>'center'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-content-wrap { text-align:{{contentAlign}}; } {{WOPB}} .wopb-grid3-quick-cart {justify-content: center;}'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'contentAlign','condition'=>'==','value'=>'right'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-content-wrap { text-align:{{contentAlign}}; } {{WOPB}} .wopb-grid3-quick-cart {justify-content: flex-end;}'
                    ],
                ],
            ],

            //--------------------------
            //      Query Setting
            //--------------------------
            'queryType' => [
                'type' => 'string',
                'default' => 'product'
            ],
            'queryNumber' => [
                'type' => 'string',
                'default' => 8,
            ],
            'queryStatus' => [
                'type' => 'string',
                'default' => 'all',
            ],
            'queryExcludeStock' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'queryCat' => [
                'type' => 'string',
                'default' => '[]',
            ],
            'queryOrderBy' => [
                'type' => 'string',
                'default' => 'date'
            ],
            'queryOrder' => [
                'type' => 'string',
                'default' => 'desc',
            ],
            'queryInclude' => [
                'type' => 'string',
                'default' => ''
            ],
            'queryExclude' => [
                'type' => 'string',
                'default' => ''
            ],
            'queryOffset' => [
                'type' => 'string',
                'default' => 0,
            ],
            'queryQuick' => [
                'type' => 'string',
                'default' => '',
            ],

            //--------------------------
            //      Arrow Setting
            //--------------------------
            'arrowStyle' => [
                'type' => 'string',
                'default' => 'leftAngle2#rightAngle2',
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'showArrows','condition'=>'==','value'=>true],
                        ],
                    ],
                ]
            ],
            'arrowSize' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'showArrows','condition'=>'==','value'=>true],
                        ],
                        'selector' => '{{WOPB}} .slick-next svg, {{WOPB}} .slick-prev svg { width:{{arrowSize}}; }'
                    ],
                ]
            ],
            'arrowWidth' => [
                'type' => 'object',
                'default' => (object)['lg' =>'60', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'showArrows','condition'=>'==','value'=>true],
                        ],
                        'selector' => '{{WOPB}} .slick-arrow { width:{{arrowWidth}}; }'
                    ],
                ]
            ],
            'arrowHeight' => [
                'type' => 'object',
                'default' => (object)['lg' =>'60', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'showArrows','condition'=>'==','value'=>true],
                        ],
                        'selector' => '{{WOPB}} .slick-arrow { height:{{arrowHeight}}; } {{WOPB}} .slick-arrow { line-height:{{arrowHeight}}; }'
                    ],
                ]
            ],
            'arrowVartical' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'showArrows','condition'=>'==','value'=>true],
                        ],
                        'selector' => '{{WOPB}} .slick-next { right:{{arrowVartical}}; } {{WOPB}} .slick-prev { left:{{arrowVartical}}; }'
                    ],
                ]
            ],
            'arrowHorizontal' => [
                'type' => 'object',
                'default' => (object)['lg'=>''],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'showDots','condition'=>'==','value'=>true],
                        ],
                        'selector' => '{{WOPB}} .slick-next, {{WOPB}} .slick-prev { top:{{arrowHorizontal}}; }'
                    ],
                ]
            ],
            'arrowColor' => [
                'type' => 'string',
                'default' => '#ffffff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showArrows','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-arrow:before { color:{{arrowColor}}; } {{WOPB}} .slick-arrow svg { fill:{{arrowColor}}; }'
                    ],
                ],
            ],
            'arrowHoverColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showArrows','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-arrow:hover:before { color:{{arrowHoverColor}}; } {{WOPB}} .slick-arrow:hover svg { fill:{{arrowHoverColor}}; }'
                    ],
                ],
            ],
            'arrowBg' => [
                'type' => 'string',
                'default' => 'rgba(0,0,0,0.22)',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showArrows','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-arrow { background:{{arrowBg}}; }'
                    ],
                ],
            ],
            'arrowHoverBg' => [
                'type' => 'string',
                'default' => '#ff5845',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showArrows','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-arrow:hover { background:{{arrowHoverBg}}; }'
                    ],
                ],
            ],
            'arrowBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showArrows','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-arrow'
                    ],
                ],
            ],
            'arrowHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showArrows','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-arrow:hover'
                    ],
                ],
            ],
            'arrowRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '50','bottom' => '50', 'left' => '50','right' => '50', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showArrows','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-arrow { border-radius: {{arrowRadius}}; }'
                    ],
                ],
            ],
            'arrowHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '50','bottom' => '50', 'left' => '50','right' => '50', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showArrows','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-arrow:hover{ border-radius: {{arrowHoverRadius}}; }'
                    ],
                ],
            ],
            'arrowShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showArrows','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-arrow'
                    ],
                ],
            ],
            'arrowHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showArrows','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-arrow:hover'
                    ],
                ],
            ],


            //--------------------------
            // Dot Setting/Style
            //--------------------------
            'dotSpace' => [
                'type' => 'object',
                'default' => (object)['lg' =>'4', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'showDots','condition'=>'==','value'=>true],
                        ],
                        'selector' => '{{WOPB}} .slick-dots { padding: 0 {{dotSpace}}; } {{WOPB}} .slick-dots li button { margin: 0 {{dotSpace}}; }'
                    ],
                ]
            ],
            'dotVartical' => [
                'type' => 'object',
                'default' => (object)['lg' =>'-50', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'showDots','condition'=>'==','value'=>true],
                        ],
                        'selector' => '{{WOPB}} .slick-dots { bottom:{{dotVartical}}; }'
                    ],
                ]
            ],
            'dotHorizontal' => [
                'type' => 'object',
                'default' => (object)['lg'=>''],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'showDots','condition'=>'==','value'=>true],
                        ],
                        'selector' => '{{WOPB}} .slick-dots { left:{{dotHorizontal}}; }'
                    ],
                ]
            ],
            'dotWidth' => [
                'type' => 'object',
                'default' => (object)['lg' =>'10', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'showDots','condition'=>'==','value'=>true],
                        ],
                        'selector' => '{{WOPB}} .slick-dots li button  { width:{{dotWidth}}; }'
                    ],
                ]
            ],
            'dotHeight' => [
                'type' => 'object',
                'default' => (object)['lg' =>'10', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'showDots','condition'=>'==','value'=>true],
                        ],
                        'selector' => '{{WOPB}} .slick-dots li button  { height:{{dotHeight}}; }'
                    ],
                ]
            ],
            'dotHoverWidth' => [
                'type' => 'object',
                'default' => (object)['lg' =>'16', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'showDots','condition'=>'==','value'=>true],
                        ],
                        'selector' => '{{WOPB}} .slick-dots li.slick-active button { width:{{dotHoverWidth}}; }'
                    ],
                ]
            ],
            'dotHoverHeight' => [
                'type' => 'object',
                'default' => (object)['lg' =>'16', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'showDots','condition'=>'==','value'=>true],
                        ],
                        'selector' => '{{WOPB}} .slick-dots li.slick-active button { height:{{dotHoverHeight}}; }'
                    ],
                ]
            ],
            'dotBg' => [
                'type' => 'string',
                'default' => '#f5f5f5',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDots','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-dots li button { background:{{dotBg}}; }'
                    ],
                ],
            ],
            'dotHoverBg' => [
                'type' => 'string',
                'default' => '#000',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDots','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-dots li button:hover, {{WOPB}} .slick-dots li.slick-active button { background:{{dotHoverBg}}; }'
                    ],
                ],
            ],
            'dotBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDots','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-dots li button'
                    ],
                ],
            ],
            'dotHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDots','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-dots li button:hover, {{WOPB}} .slick-dots li.slick-active button'
                    ],
                ],
            ],
            'dotRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '50','bottom' => '50','left' => '50','right' => '50', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDots','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-dots li button { border-radius: {{dotRadius}}; }'
                    ],
                ],
            ],
            'dotHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '50','bottom' => '50','left' => '50','right' => '50', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDots','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-dots li button:hover, {{WOPB}} .slick-dots li.slick-active button { border-radius: {{dotHoverRadius}}; }'
                    ],
                ],
            ],
            'dotShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDots','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-dots li button'
                    ],
                ],
            ],
            'dotHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDots','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .slick-dots li button:hover, {{WOPB}} .slick-dots li.slick-active button'
                    ],
                ],
            ],


            //--------------------------
            //      Heading Setting/Style
            //--------------------------
            'headingText' => [
                'type' => 'string',
                'default' => 'Product Grid #2',
            ],
            'headingURL' => [
                'type' => 'string',
                'default' => '',
            ],
            'headingBtnText' => [
                'type' => 'string',
                'default' =>  'View More',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style11'],
                        ],
                    ],
                ],
            ],
            'headingStyle' => [
                'type' => 'string',
                'default' => 'style1',
            ],
            'headingTag' => [
                'type' => 'string',
                'default' => 'h2',
            ],
            'headingAlign' => [
                'type' => 'string',
                'default' =>  'left',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=> false],
                        ],
                        'selector' => '
                            {{WOPB}} .wopb-heading-inner, {{WOPB}} .wopb-sub-heading-inner{ text-align:{{headingAlign}}; } 
                            {{WOPB}} .wopb-heading-filter-in{ display: block; }'
                    ]
                ]
            ],
            'headingTypo' => [
                'type' => 'object',
                'default' =>  (object)['openTypography' => 1,'size' => (object)['lg' => '20', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => 'none', 'transform' => 'uppercase', 'family'=>'','weight'=>'700'],
                'style' => [(object)['selector' => '{{WOPB}} .wopb-heading-wrap .wopb-heading-inner']]
            ],
            'headingColor' => [
                'type' => 'string',
                'default' =>  '#0e1523',
                'style' => [(object)['selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner span { color:{{headingColor}}; }']],
            ],
            'headingBorderBottomColor' => [
                'type' => 'string',
                'default' =>  '#0e1523',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style3'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner { border-bottom-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style4'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner { border-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style6'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner span:before { background-color: {{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style7'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner span:before { background-color: {{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style8'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:after { background-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style9'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:before { background-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style10'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:before { background-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style13'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner { border-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style14'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:before { background-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style15'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner span:before { background-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style16'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner span:before { background-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style17'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:before { background-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style18'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:after { background-color:{{headingBorderBottomColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style19'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:before { border-color:{{headingBorderBottomColor}}; }'
                    ],
                ],
            ],
            'headingBorderBottomColor2' => [
                'type' => 'string',
                'default' =>  '#e5e5e5',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style8'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:before { background-color:{{headingBorderBottomColor2}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style10'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:after { background-color:{{headingBorderBottomColor2}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style14'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:after { background-color:{{headingBorderBottomColor2}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style19'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:after { background-color:{{headingBorderBottomColor2}}; }'
                    ],
                ],
            ],
            'headingBg' => [
                'type' => 'string',
                'default' =>  '#ff5845',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style5'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-style5 .wopb-heading-inner span:before { border-color:{{headingBg}} transparent transparent; } {{WOPB}} .wopb-heading-inner span { background-color:{{headingBg}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style2'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner span { background-color:{{headingBg}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style3'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner span { background-color:{{headingBg}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style12'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner span { background-color:{{headingBg}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style13'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner span { background-color:{{headingBg}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style18'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner { background-color:{{headingBg}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style20'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner span:before { border-color:{{headingBg}} transparent transparent; } {{WOPB}} .wopb-heading-inner { background-color:{{headingBg}}; }'
                    ],
                ],
            ],
            'headingBg2' => [
                'type' => 'string',
                'default' =>  '#e5e5e5',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style12'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner { background-color:{{headingBg2}}; }'
                    ],
                ],
            ],
            'headingBtnTypo' => [
                'type' => 'object',
                'default' =>  (object)['openTypography' => 1,'size' => (object)['lg' => '14', 'unit' => 'px'], 'height' => (object)['lg' => '', 'unit' => 'px'],'decoration' => 'none','family'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style11'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-btn'
                    ],
                ],
            ],
            'headingBtnColor' => [
                'type' => 'string',
                'default' =>  '#ff5845',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style11'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-btn { color:{{headingBtnColor}}; } {{WOPB}} .wopb-heading-btn svg { fill:{{headingBtnColor}}; }'
                    ],
                ],
            ],
            'headingBtnHoverColor' => [
                'type' => 'string',
                'default' =>  '#0a31da',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style11'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-btn:hover { color:{{headingBtnHoverColor}}; } {{WOPB}} .wopb-heading-btn:hover svg { fill:{{headingBtnHoverColor}}; }'
                    ],
                ],
            ],
            
            'headingBorder' => [
                'type' => 'string',
                'default' => '3',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style3'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner { border-bottom-width:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style4'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner { border-width:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style6'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner span:before { width:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style7'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner span:before { height:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style8'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:before, {{WOPB}} .wopb-heading-inner:after { height:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style9'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:before { height:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style10'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:before, {{WOPB}} .wopb-heading-inner:after { height:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style13'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner { border-width:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style14'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:before, {{WOPB}} .wopb-heading-inner:after { height:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style15'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner span:before { height:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style16'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner span:before { height:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style17'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:before { height:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style19'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:after { width:{{headingBorder}}px; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style18'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-inner:after { width:{{headingBorder}}px; }'
                    ],
                ],
            ],
            'headingSpacing' => [
                'type' => 'object',
                'default' => (object)['lg'=>25, 'unit'=>'px'],
                'style' => [(object)['selector'=>'{{WOPB}} .wopb-heading-wrap {margin-top:0; margin-bottom:{{headingSpacing}}; }']]
            ],

            'headingRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '','left' => '', 'right' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style2'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner span { border-radius:{{headingRadius}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style3'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner span { border-radius:{{headingRadius}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style4'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner { border-radius:{{headingRadius}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style5'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner span { border-radius:{{headingRadius}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style12'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner { border-radius:{{headingRadius}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style13'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner { border-radius:{{headingRadius}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style18'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner { border-radius:{{headingRadius}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style20'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner { border-radius:{{headingRadius}}; }'
                    ],
                ]
            ],


            'headingPadding' => [
                'type' => 'object',
                'default' => (object)['lg'=>'', 'unit'=>'px'],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style2'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style3'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style4'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style5'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style6'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style12'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style13'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style18'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style19'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'headingStyle','condition'=>'==','value'=>'style20'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-wrap .wopb-heading-inner span { padding:{{headingPadding}}; }'
                    ],
                ]
            ],
            'subHeadingShow' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'subHeadingText' => [
                'type' => 'string',
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ut sem augue. Sed at felis ut enim dignissim sodales.',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'subHeadingShow','condition'=>'==','value'=>true],
                        ],
                    ],
                ],
            ],
            'subHeadingTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography'=>1,'size'=>(object)['lg'=>'16', 'unit'=>'px'], 'spacing'=>(object)[ 'lg'=>'0', 'unit'=>'px'], 'height'=>(object)[ 'lg'=>'27', 'unit'=>'px'],'decoration'=>'none','transform' => 'capitalize','family'=>'','weight'=>'500'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'subHeadingShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-sub-heading div'
                    ],
                ],
            ],
            'subHeadingColor' => [
                'type' => 'string',
                'default' =>  '#989898',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'subHeadingShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-sub-heading div{ color:{{subHeadingColor}}; }'
                    ],
                ],
            ],
            'subHeadingSpacing' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'subHeadingShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} div.wopb-sub-heading-inner{ margin:{{subHeadingSpacing}}; }'
                    ],
                ],
            ],


            //--------------------------
            //      Price Setting/Style
            //--------------------------
            'priceColor' => [
                'type' => 'string',
                'default' => '#565656',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showPrice','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-price { color:{{priceColor}}; }'
                    ],
                ],
            ],
            'priceTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography'=>1,'size'=>(object)['lg'=>'16', 'unit'=>'px'], 'spacing'=>(object)[ 'lg'=>'0', 'unit'=>'px'], 'height'=>(object)[ 'lg'=>'26', 'unit'=>'px'],'decoration'=>'none','transform' => 'capitalize','family'=>'','weight'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showPrice','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-price'
                    ],
                ],
            ],
            'pricePadding' => [
                'type' => 'object',
                'default' => (object)['lg'=>(object)['top'=>0,'bottom'=>0, 'unit'=>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showPrice','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-price { padding:{{pricePadding}}; }'
                    ],
                ],
            ],

            //--------------------------
            //      Sales Setting/Style
            //--------------------------
            'saleText' => [
                'type' => 'string',
                'default' => 'Sale!'
            ],
            'salePosition' => [
                'type' => 'string',
                'default' => 'topLeft',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'salePosition','condition'=>'==','value'=>'topLeft'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-onsale-hot{top:15px;left:15px;}',
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'salePosition','condition'=>'==','value'=>'topRight'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-onsale-hot{top:15px;right:15px;}',
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'salePosition','condition'=>'==','value'=>'buttonLeft'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-onsale-hot{bottom:15px;left:15px;}',
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'salePosition','condition'=>'==','value'=>'buttonRight'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-onsale-hot{bottom:15px;right:15px;}',
                    ],
               ],
            ],
            'saleDesign' => [
                'type' => 'string',
                'default' => 'text',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showSale','condition'=>'==','value'=>true],
                        ],
                    ],
                ],
            ],
            'saleStyle' => [
                'type' => 'string',
                'default' => 'classic',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showSale','condition'=>'==','value'=>true],
                        ],
                    ],
                ],
            ],
            'salesColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showSale','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-onsale { color:{{salesColor}}; }'
                    ],
                ],
            ],
            'salesBgColor' => [
                'type' => 'string',
                'default' => '#31b54e',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showSale','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-onsale { background:{{salesBgColor}}; } {{WOPB}} .wopb-onsale.wopb-onsale-ribbon:before { border-left: 23px solid {{salesBgColor}}; border-right: 23px solid {{salesBgColor}}; }'
                    ],
                ],
            ],
            'salesTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography'=>1,'size'=>(object)['lg'=>'11', 'unit'=>'px'], 'spacing'=>(object)[ 'lg'=>'0', 'unit'=>'px'], 'height'=>(object)[ 'lg'=>'20', 'unit'=>'px'],'decoration'=>'none','transform' => 'uppercase','family'=>'','weight'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showSale','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-onsale'
                    ],
                ],
            ],
            'salesPadding' => [
                'type' => 'object',
                'default' => (object)['lg'=>(object)['top'=>4,'bottom'=>4,'left'=>8,'right'=>8, 'unit'=>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showSale','condition'=>'==','value'=>true],
                            (object)['key'=>'saleStyle','condition'=>'==','value'=>'classic'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-onsale.wopb-onsale-classic { padding:{{salesPadding}}; }'
                    ],
                ],
            ],
            'salesRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'2', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showSale','condition'=>'==','value'=>true],
                            (object)['key'=>'saleStyle','condition'=>'==','value'=>'classic'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-onsale.wopb-onsale-classic { border-radius:{{salesRadius}}; }'
                    ],
                ],
            ],


            //--------------------------
            //      Hot Setting/Style
            //--------------------------
            'hotText' => [
                'type' => 'string',
                'default' => 'Hot'
            ],
            'hotColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showHot','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-onsale-hot .wopb-hot { color:{{hotColor}}; }'
                    ],
                ],
            ],
            'hotBgColor' => [
                'type' => 'string',
                'default' => '#EB1E37',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showHot','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-onsale-hot .wopb-hot { background:{{hotBgColor}}; }'
                    ],
                ],
            ],
            'hotTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography'=>1,'size'=>(object)['lg'=>'', 'unit'=>'px'], 'spacing'=>(object)[ 'lg'=>'', 'unit'=>'px'], 'height'=>(object)[ 'lg'=>'', 'unit'=>'px'],'decoration'=>'none','transform' => 'uppercase','family'=>'','weight'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showHot','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-onsale-hot .wopb-hot'
                    ],
                ],
            ],
            'hotPadding' => [
                'type' => 'object',
                'default' => (object)['lg'=>(object)['unit'=>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showHot','condition'=>'==','value'=>true]
                        ],
                        'selector'=>'{{WOPB}} .wopb-onsale-hot .wopb-hot { padding:{{hotPadding}}; }'
                    ],
                ],
            ],
            'hotRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'2', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showHot','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-onsale-hot .wopb-hot { border-radius:{{hotRadius}}; }'
                    ],
                ],
            ],

            //--------------------------
            //      Deal Setting/Style
            //--------------------------
            'dealText' => [
                'type' => 'string',
                'default' => 'Days|Hours|Minutes|Seconds'
            ],
            'dealColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDeal','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-deals>div { color:{{dealColor}}; }'
                    ],
                ],
            ],
            'dealBgColor' => [
                'type' => 'string',
                'default' => '#000',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDeal','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-deals { background:{{dealBgColor}}; }'
                    ],
                ],
            ],
            'dealCountTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography'=>1,'size'=>(object)['lg'=>'', 'unit'=>'px'], 'spacing'=>(object)[ 'lg'=>'', 'unit'=>'px'], 'height'=>(object)[ 'lg'=>'', 'unit'=>'px'],'decoration'=>'none','transform' => '','family'=>'','weight'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDeal','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-deals>div strong'
                    ],
                ],
            ],
            'dealDayTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography'=>1,'size'=>(object)['lg'=>'', 'unit'=>'px'], 'spacing'=>(object)[ 'lg'=>'', 'unit'=>'px'], 'height'=>(object)[ 'lg'=>'', 'unit'=>'px'],'decoration'=>'none','transform' => '','family'=>'','weight'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDeal','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-deals>div span'
                    ],
                ],
            ],
            'dealSpacer' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDeal','condition'=>'==','value'=>true]
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-deals>div { margin: 0 {{dealSpacer}}; }'
                    ],
                ],
            ],
            'dealPadding' => [
                'type' => 'object',
                'default' => (object)['lg'=>(object)['unit'=>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDeal','condition'=>'==','value'=>true]
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-deals { padding:{{dealPadding}}; }'
                    ],
                ],
            ],
            'dealRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'2', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showDeal','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-deals { border-radius:{{dealRadius}}; }'
                    ],
                ],
            ],

            //--------------------------
            // Review Setting/Style
            //--------------------------
            'reviewEmptyColor' => [
                'type' => 'string',
                'default' => '#cccccc',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showReview','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-star-rating:before { color:{{reviewEmptyColor}}; }'
                    ],
                ],
            ],
            'reviewFillColor' => [
                'type' => 'string',
                'default' => '#ffd810',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showReview','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-star-rating span:before { color:{{reviewFillColor}}; }'
                    ],
                ],
            ],
            'reviewMargin' => [
                'type' => 'object',
                'default' => (object)['lg'=>(object)['top'=>10,'bottom'=>0, 'unit'=>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showReview','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-star-rating { margin:{{reviewMargin}}; }'
                    ],
                ],
            ],
            

            //--------------------------
            // Short Desc Setting/Style
            //--------------------------
            'shortDescLimit' => [
                'type' => 'string',
                'default' => 7,
            ],
            'ShortDescTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography'=>1,'size'=>(object)['lg'=>'14', 'unit'=>'px'], 'spacing'=>(object)[ 'lg'=>'0', 'unit'=>'px'], 'height'=>(object)[ 'lg'=>'22', 'unit'=>'px'],'decoration'=>'none','transform' => 'capitalize','family'=>'','weight'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showShortDesc','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-short-description'
                    ],
                ],
            ],
            'ShortDescColor' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showShortDesc','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-short-description { color:{{ShortDescColor}}; }'
                    ],
                ],
            ],
            'ShortDescPadding' => [
                'type' => 'object',
                'default' => (object)['lg'=>(object)['top'=>0,'bottom'=>0, 'unit'=>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showShortDesc','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-short-description { padding:{{ShortDescPadding}}; }'
                    ],
                ],
            ],

            //--------------------------
            //  Title Setting/Style
            //--------------------------
            'titleTag' => [
                'type' => 'string',
                'default' => 'h3',
            ],
            'titleFull' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'selector' => '{{WOPB}} .wopb-block-title{display: -webkit-box;}'
                    ],
                ],
            ],
            'titleTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography'=>1,'size'=>(object)['lg'=>'16', 'unit'=>'px'], 'spacing'=>(object)[ 'lg'=>'0', 'unit'=>'px'], 'height'=>(object)[ 'lg'=>'24', 'unit'=>'px'],'decoration'=>'none','transform' => 'capitalize','family'=>'','weight'=>'600'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'titleShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-title, {{WOPB}} .wopb-block-title a'
                    ],
                ],
            ],
            'titleColor' => [
                'type' => 'string',
                'default' => '#0e1523',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'titleShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-title a { color:{{titleColor}}; }'
                    ],
                ],
            ],
            'titleHoverColor' => [
                'type' => 'string',
                'default' => '#828282',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'titleShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-title a:hover { color:{{titleHoverColor}}; }'
                    ],
                ],
            ],
            'titlePadding' => [
                'type' => 'object',
                'default' => (object)['lg'=>(object)['top'=>0,'bottom'=>2, 'unit'=>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'titleShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-title { padding:{{titlePadding}}; }'
                    ],
                ],
            ],

            //--------------------------
            // Cart Setting/Style
            //--------------------------
            'cartText' => [
                'type' => 'string',
                'default' => '',
            ],
            'cartActive' => [
                'type' => 'string',
                'default' => 'View Cart',
            ],
            'cartTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography' => 1, 'size' => (object)['lg' =>12, 'unit' =>'px'], 'height' => (object)['lg' =>'24', 'unit' =>'px'], 'spacing' => (object)['lg' =>0, 'unit' =>'px'], 'transform' => 'uppercase', 'weight' => '600', 'decoration' => 'none','family'=>'' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showCart','condition'=>'==','value'=>true],
                            (object)['key'=>'layout','condition'=>'==','value'=>['1', '2', '3']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-grid3-content .wopb-product-btn a'
                    ],
                ],
            ],
            'cartColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showCart','condition'=>'==','value'=>true],
                            (object)['key'=>'layout','condition'=>'==','value'=>['1', '2', '3']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-grid3-content .wopb-product-btn a { color:{{cartColor}}; }'
                    ],
                ],
            ],
            'cartBgColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1,'type' => 'color', 'color' => '#ff5845'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showCart','condition'=>'==','value'=>true],
                            (object)['key'=>'layout','condition'=>'==','value'=>['1', '2', '3']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-grid3-content .wopb-product-btn a'
                    ],
                ],
            ],
            'cartBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#ff5845','type' => 'solid'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showCart','condition'=>'==','value'=>true],
                            (object)['key'=>'layout','condition'=>'==','value'=>['1', '2', '3']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-grid3-content .wopb-product-btn a'
                    ],
                ],
            ],
            'cartRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'2', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showCart','condition'=>'==','value'=>true],
                            (object)['key'=>'layout','condition'=>'==','value'=>['1', '2', '3']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-grid3-content .wopb-product-btn a { border-radius:{{cartRadius}}; }'
                    ],
                ],
            ],
            'cartHoverColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showCart','condition'=>'==','value'=>true],
                            (object)['key'=>'layout','condition'=>'==','value'=>['1', '2', '3']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-grid3-content .wopb-product-btn a:hover { color:{{cartHoverColor}}; }'
                    ],
                ],
            ],
            'cartBgHoverColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1, 'type' => 'color', 'color' => '#e63838'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showCart','condition'=>'==','value'=>true],
                            (object)['key'=>'layout','condition'=>'==','value'=>['1', '2', '3']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-grid3-content .wopb-product-btn a:hover'
                    ],
                ],
            ],
            'cartHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#ff5845','type' => 'solid'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showCart','condition'=>'==','value'=>true],
                            (object)['key'=>'layout','condition'=>'==','value'=>['1', '2', '3']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-grid3-content .wopb-product-btn a:hover'
                    ],
                ],
            ],
            'cartHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'2', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showCart','condition'=>'==','value'=>true],
                            (object)['key'=>'layout','condition'=>'==','value'=>['1', '2', '3']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-grid3-content .wopb-product-btn a:hover { border-radius:{{cartHoverRadius}}; }'
                    ],
                ],
            ],
            'cartSpacing' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => 20,'bottom' => '','left' => '','right' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showCart','condition'=>'==','value'=>true],
                            (object)['key'=>'layout','condition'=>'==','value'=>['1', '2', '3']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-grid3-quick-cart { margin:{{cartSpacing}}; } {{WOPB}}.wp-block-product-blocks-product-grid-2 .wopb-product-grid3-overlay { margin-bottom: -160px; }'
                    ],
                ],
            ],
            'cartPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '5','bottom' => '5','left' => '12','right' => '12', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showCart','condition'=>'==','value'=>true],
                            (object)['key'=>'layout','condition'=>'==','value'=>['1', '2', '3']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-product-grid3-content .wopb-product-btn a { padding:{{cartPadding}}; }'
                    ],
                ],
            ],


            //--------------------------
            // Category Setting/Style
            //--------------------------
            'catPosition' => [
                'type' => 'string',
                'default' => 'none',
            ],
            'catTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography' => 1, 'size' => (object)['lg' =>12, 'unit' =>'px'], 'height' => (object)['lg' =>22, 'unit' =>'px'], 'spacing' => (object)['lg' =>0, 'unit' =>'px'], 'transform' => 'uppercase', 'weight' => '400', 'decoration' => 'none','family'=>'' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-category-grid a'
                    ],
                ],
            ],
            'catColor' => [
                'type' => 'string',
                'default' => '#828282',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-category-grid a { color:{{catColor}}; }'
                    ],
                ],
            ],
            'catBgColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1,'type' => 'color', 'color' => ''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-category-grid a'
                    ],
                ],
            ],
            'catBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-category-grid a'
                    ],
                ],
            ],
            'catRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-category-grid a { border-radius:{{catRadius}}; }'
                    ],
                ],
            ],
            'catHoverColor' => [
                'type' => 'string',
                'default' => '#ff5845',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-category-grid a:hover { color:{{catHoverColor}}; }'
                    ],
                ],
            ],
            'catBgHoverColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1, 'type' => 'color', 'color' => ''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-category-grid a:hover'
                    ],
                ],
            ],
            'catHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-category-grid a:hover'
                    ],
                ],
            ],
            'catSacing' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => 0,'bottom' => 0,'left' => 0,'right' => 0, 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-category-grid { margin:{{catSacing}}; }'
                    ],
                ],
            ],
            'catPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => "0",'bottom' => "0",'left' => "0",'right' => "0", 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'catShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-category-grid a { padding:{{catPadding}}; }'
                    ],
                ],
            ],


            //--------------------------
            // Meta Elements Setting/Style
            //--------------------------
            'metaElementColor' => [
                'type' => 'string',
                'default' => '#000',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'!=','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l1 .wopb-product-meta a svg, {{WOPB}} .wopb-pg-l2 .wopb-quick-cart a svg, {{WOPB}} .wopb-pg-l2 .wopb-product-meta a svg, {{WOPB}} .wopb-pg-l3 .wopb-product-meta a svg, {{WOPB}} .wopb-pg-l5 .wopb-product-meta a svg { fill:{{metaElementColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l4 .wopb-product-meta a svg, {{WOPB}} .wopb-pg-l6 .wopb-product-meta a svg { fill:{{metaElementColor}}; }'
                    ],
                ],
            ],
            'metaElementBg' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'!=','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l1 .wopb-product-meta a, {{WOPB}} .wopb-pg-l2 .wopb-quick-cart :not(.wopb-product-btn) a, {{WOPB}} .wopb-pg-l2 .wopb-product-meta a, {{WOPB}} .wopb-pg-l3 .wopb-product-meta a, {{WOPB}} .wopb-pg-l5 .wopb-product-meta a { background:{{metaElementBg}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l4 .wopb-product-meta, {{WOPB}} .wopb-pg-l6 .wopb-product-meta { background:{{metaElementBg}}; }'
                    ],
                ],
            ],
            'metaElementBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'!=','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l1 .wopb-product-meta a, {{WOPB}} .wopb-pg-l2 .wopb-quick-cart .wopb-compare-btn a, {{WOPB}} .wopb-pg-l2 .wopb-quick-cart :not(.wopb-product-btn) a, {{WOPB}} .wopb-pg-l2 .wopb-product-meta a, {{WOPB}} .wopb-pg-l3 .wopb-product-meta a, {{WOPB}} .wopb-pg-l5 .wopb-product-meta a'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l4 .wopb-product-meta, {{WOPB}} .wopb-pg-l6 .wopb-product-meta'
                    ],
                ],
            ],
            'metaElementRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'!=','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l1 .wopb-product-meta a, {{WOPB}} .wopb-pg-l2 .wopb-quick-cart :not(.wopb-product-btn) a, {{WOPB}} .wopb-pg-l2 .wopb-product-meta a, {{WOPB}} .wopb-pg-l3 .wopb-product-meta a, {{WOPB}} .wopb-pg-l5 .wopb-product-meta a { border-radius:{{metaElementRadius}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l4 .wopb-product-meta, {{WOPB}} .wopb-pg-l6 .wopb-product-meta { border-radius:{{metaElementRadius}}; }'
                    ],
                ],
            ],
            'metaElementShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'!=','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l1 .wopb-product-meta a, {{WOPB}} .wopb-pg-l2 .wopb-quick-cart :not(.wopb-product-btn) a, {{WOPB}} .wopb-pg-l2 .wopb-product-meta a, {{WOPB}} .wopb-pg-l3 .wopb-product-meta a, {{WOPB}} .wopb-pg-l5 .wopb-product-meta a'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l4 .wopb-product-meta, {{WOPB}} .wopb-pg-l6 .wopb-product-meta'
                    ],
                ],
            ],
            'metaElementHoverColor' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'!=','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l1 .wopb-product-meta a:hover svg, {{WOPB}} .wopb-pg-l2 .wopb-quick-cart :not(.wopb-product-btn) a:hover svg, {{WOPB}} .wopb-pg-l2 .wopb-product-meta a:hover svg, {{WOPB}} .wopb-pg-l3 .wopb-product-meta a:hover svg, {{WOPB}} .wopb-pg-l5 .wopb-product-meta a:hover svg { fill:{{metaElementHoverColor}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l4 .wopb-product-meta:hover a:hover svg, {{WOPB}} .wopb-pg-l6 .wopb-product-meta:hover a:hover svg { fill:{{metaElementHoverColor}}; }'
                    ],
                ],
            ],
            'metaElementHoverBg' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'!=','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l1 .wopb-product-meta a:hover, {{WOPB}} .wopb-pg-l2 .wopb-quick-cart :not(.wopb-product-btn) a:hover, {{WOPB}} .wopb-pg-l2 .wopb-product-meta a:hover, {{WOPB}} .wopb-pg-l3 .wopb-product-meta a:hover, {{WOPB}} .wopb-pg-l5 .wopb-product-meta a:hover { background:{{metaElementHoverBg}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l4 .wopb-product-meta:hover, {{WOPB}} .wopb-pg-l6 .wopb-product-meta:hover { background:{{metaElementHoverBg}}; }'
                    ],
                ],
            ],
            'metaElementHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'!=','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l1 .wopb-product-meta a:hover, {{WOPB}} .wopb-pg-l2 .wopb-quick-cart :not(.wopb-product-btn) a:hover, {{WOPB}} .wopb-pg-l2 .wopb-product-meta a:hover, {{WOPB}} .wopb-pg-l3 .wopb-product-meta a:hover, {{WOPB}} .wopb-pg-l5 .wopb-product-meta a:hover'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l4 .wopb-product-meta:hover, {{WOPB}} .wopb-pg-l6 .wopb-product-meta:hover'
                    ],
                ],
            ],
            'metaElementHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'!=','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l1 .wopb-product-meta a:hover, {{WOPB}} .wopb-pg-l2 .wopb-quick-cart :not(.wopb-product-btn) a:hover, {{WOPB}} .wopb-pg-l2 .wopb-product-meta a:hover, {{WOPB}} .wopb-pg-l3 .wopb-product-meta a:hover, {{WOPB}} .wopb-pg-l5 .wopb-product-meta a:hover { border-radius:{{metaElementHoverRadius}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l4 .wopb-product-meta:hover, {{WOPB}} .wopb-pg-l6 .wopb-product-meta:hover { border-radius:{{metaElementHoverRadius}}; }'
                    ],
                ],
            ],
            'metaElementHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'!=','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l1 .wopb-product-meta a:hover, {{WOPB}} .wopb-pg-l2 .wopb-quick-cart :not(.wopb-product-btn) a:hover, {{WOPB}} .wopb-pg-l2 .wopb-product-meta a:hover, {{WOPB}} .wopb-pg-l3 .wopb-product-meta a:hover, {{WOPB}} .wopb-pg-l5 .wopb-product-meta a:hover'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l4 .wopb-product-meta:hover, {{WOPB}} .wopb-pg-l6 .wopb-product-meta:hover'
                    ],
                ],
            ],
            'metaElementSpacer' => [
                'type' => 'object',
                'default' => (object)['lg' =>'10', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'layout','condition'=>'!=','value'=>['4', '6']],
                        ],
                        'selector' => '{{WOPB}} .wopb-pg-l1 .wopb-product-meta a:not(:last-child), {{WOPB}} .wopb-pg-l3 .wopb-product-meta a:not(:last-child) { margin-bottom:{{metaElementSpacer}}; } {{WOPB}} .wopb-pg-l5 .wopb-product-meta a:not(:last-child) { margin-right:{{metaElementSpacer}}; } {{WOPB}} .wopb-pg-l5 .wopb-product-meta .wopb-product-btn a { margin-right:0; } {{WOPB}} .wopb-pg-l2 .wopb-quick-cart > div { margin:0 {{metaElementSpacer}}; }'
                    ],
                    (object)[
                        'depends' => [ 
                            (object)['key'=>'layout','condition'=>'==','value'=>['4', '6']],
                        ],
                        'selector' => '{{WOPB}} .wopb-pg-l4 .wopb-product-meta a:not(:last-child) { margin-bottom:{{metaElementSpacer}}; } {{WOPB}} .wopb-pg-l4 .wopb-product-meta .wopb-product-btn a { margin-bottom:0; } {{WOPB}} .wopb-pg-l6 .wopb-product-meta a:not(:last-child) { margin-right:{{metaElementSpacer}}; } {{WOPB}} .wopb-pg-l6 .wopb-product-meta .wopb-product-btn a { margin-right:0; }'
                    ],
                ]
            ],
            'metaElementPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'!=','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l1 .wopb-product-meta a, {{WOPB}} .wopb-pg-l2 .wopb-quick-cart :not(.wopb-product-btn) a, {{WOPB}} .wopb-pg-l2 .wopb-product-meta a, {{WOPB}} .wopb-pg-l3 .wopb-product-meta a, {{WOPB}} .wopb-pg-l5 .wopb-product-meta a { padding:{{metaElementPadding}}; }'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'layout','condition'=>'==','value'=>['4', '6']],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pg-l4 .wopb-product-meta, {{WOPB}} .wopb-pg-l6 .wopb-product-meta { padding:{{metaElementPadding}}; }'
                    ],
                ],
            ],

            //--------------------------
            // Image Setting/Style
            //--------------------------
            'imgCrop' => [
                'type' => 'string',
                'default' => 'full',
                'depends' => [(object)['key' => 'showImage','condition' => '==','value' => 'true']]
            ],
            'imgWidth' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'%'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showImage','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-item .wopb-block-image { max-width: {{imgWidth}}; }'
                    ],
                ],
            ],
            'imgHeight' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showImage','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-item .wopb-block-image img {object-fit: cover; height: {{imgHeight}}; }'
                    ],
                ],
            ],
            'imgAnimation' => [
                'type' => 'string',
                'default' => 'none',
            ],
            'imgGrayScale' => [
                'type' => 'object',
                'default' => (object)['lg' =>'0', 'unit' =>'%'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showImage','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-image img { filter: grayscale({{imgGrayScale}}); }'
                    ],
                ],
            ],
            'imgHoverGrayScale' => [
                'type' => 'object',
                'default' => (object)['lg' =>'0', 'unit' =>'%'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showImage','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-item:hover .wopb-block-image img { filter: grayscale({{imgHoverGrayScale}}); }'
                    ],
                ],
            ],
            'imgRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showImage','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-image { border-radius:{{imgRadius}}; }'
                    ],
                ],
            ],
            'imgHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showImage','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-item:hover .wopb-block-image { border-radius:{{imgHoverRadius}}; }'
                    ],
                ],
            ],
            'imgShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showImage','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-image'
                    ],
                ],
            ],
            'imgHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showImage','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-item:hover .wopb-block-image'
                    ],
                ],
            ],
            'imgMargin' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '0', 'right' => '0', 'bottom' => '15', 'left' => '0', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'showImage','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-block-item .wopb-block-image { margin: {{imgMargin}}; }'
                    ],
                ],
            ],
            
             //--------------------------
            // Filter Setting/Style
            //--------------------------
            'filterType' => [
                'type' => 'string',
                'default' => 'product_cat'
            ],
            'filterText' => [
                'type' => 'string',
                'default' => 'all'
            ],
            'filterCat' => [
                'type' => 'string',
                'default' => '[]',
                'style' => [
                    (object)[
                        'depends' => [(object)['key' => 'filterType','condition' => '==','value' => 'product_cat']]
                    ],
                ],
            ],
            'filterTag' => [
                'type' => 'string',
                'default' => '["all"]',
                'style' => [
                    (object)[
                        'depends' => [(object)['key' => 'filterType','condition' => '==','value' => 'product_tag']]
                    ],
                ],
            ],
            'filterAction' => [
                'type' => 'string',
                'default' => '[]'
            ],
            'filterActionText' => [
                'type' => 'string',
                'default' => 'Top Sale|Popular|On Sale|Most Rated|Top Rated|Featured|New Arrival',
                'style' => [
                    (object)[
                        'depends' => [(object)['key' => 'filterAction','condition' => '!=','value' => '[]']]
                    ],
                ],
            ],
            'filterBelowTitle' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-filter .wopb-filter-navigation { position: relative; display: block;margin: auto 0 0 0; }'
                    ],
                ],
            ],
            'filterAlign' => [
                'type' => 'object',
                'default' =>  (object)['lg' =>'center'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterBelowTitle','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-heading-filter .wopb-filter-navigation { text-align:{{filterAlign}}; }'
                    ],
                ],
            ],
            'fliterTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography' => 1,'size' => (object)['lg' =>14, 'unit' =>'px'],'height' => (object)['lg' =>18, 'unit' =>'px'], 'decoration' => 'none','family'=>'','weight'=>500],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-filter-wrap ul li a'
                    ],
                ],
            ],
            'filterColor' => [
                'type' => 'string',
                'default' => '#0e1523',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-filter-wrap > ul > li > a { color:{{filterColor}}; }'
                    ],
                ],
            ],
            'filterHoverColor' => [
                'type' => 'string',
                'default' =>  '#828282',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-filter-wrap > ul > li > a:hover, {{WOPB}} .wopb-filter-wrap > ul > li > a.filter-active { color:{{filterHoverColor}}; }'
                    ],
                ],
            ],
            'filterBgColor' => [
                'type' => 'string',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-filter-wrap > ul > li.filter-item > a { background:{{filterBgColor}}; }'
                    ],
                ],
            ],
            'filterHoverBgColor' => [
                'type' => 'string',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-filter-wrap > ul > li.filter-item > a:hover, {{WOPB}} .wopb-filter-wrap > ul > li.filter-item > a.filter-active { background:{{filterHoverBgColor}}; }'
                    ],
                ],
            ],
            'filterBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-filter-wrap > ul > li.filter-item > a'
                    ],
                ],
            ],
            'filterHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-filter-wrap > ul > li.filter-item > a:hover'
                    ],
                ],
            ],
            'filterRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-filter-wrap > ul > li.filter-item > a { border-radius:{{filterRadius}}; }'
                    ],
                ],
            ],
            'fliterSpacing' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '0', 'right' => '', 'left' => '20', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-filter-wrap > ul > li { margin:{{fliterSpacing}}; }'
                    ],
                ],
            ],
            'fliterPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-filter-wrap > ul > li.filter-item > a { padding:{{fliterPadding}}; }'
                    ],
                ],
            ],
            'filterDropdownColor' => [
                'type' => 'string',
                'default' =>  '#0e1523',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-filter-wrap ul li.flexMenu-viewMore .flexMenu-popup li a { color:{{filterDropdownColor}}; }'
                    ],
                ],
            ],
            'filterDropdownHoverColor' => [
                'type' => 'string',
                'default' =>  '#ff5845',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-filter-wrap ul li.flexMenu-viewMore .flexMenu-popup li a:hover { color:{{filterDropdownHoverColor}}; }'
                    ],
                ],
            ],
            'filterDropdownBg' => [
                'type' => 'string',
                'default' =>  '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}}  .wopb-filter-wrap ul li.flexMenu-viewMore .flexMenu-popup { background:{{filterDropdownBg}}; }'
                    ],
                ],
            ],
            'filterDropdownRadius' => [
                'type' => 'object',
                'default' => (object)['lg'=>'0'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}}  .wopb-filter-wrap ul li.flexMenu-viewMore .flexMenu-popup { border-radius:{{filterDropdownRadius}}; }'
                    ],
                ],
            ],
            'filterDropdownPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '15','bottom' => '15','left' => '20','right' => '20', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}}  .wopb-filter-wrap ul li.flexMenu-viewMore .flexMenu-popup { padding:{{filterDropdownPadding}}; }'
                    ],
                ],
            ],
            'filterMobile' =>  [
                'type' => 'boolean',
                'default' => true,
            ],
            'filterMobileText' => [
                'type' => 'string',
                'default' => 'More',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'filterMobile','condition'=>'==','value'=>true],
                        ]
                    ]
                ]
            ],
            

            //--------------------------
            // Pagination Setting/Style
            //--------------------------
            'paginationType' => [
                'type' => 'string',
                'default' => 'pagination',
            ],
            'loadMoreText' => [
                'type' => 'string',
                'default' => 'Load More',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationType','condition'=>'==','value'=>'loadMore'],
                        ],
                    ],
                ],
            ],
            'paginationText' => [
                'type' => 'string',
                'default' => 'Previous|Next',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationType','condition'=>'==','value'=>'pagination']
                        ]
                    ]
                ]
            ],
            'paginationNav' => [
                'type' => 'string',
                'default' => 'textArrow',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationType','condition'=>'==','value'=>'pagination'],
                        ],
                    ],
                ],
            ],
            'paginationAjax' => [
                'type' => 'boolean',
                'default' => true,
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationType','condition'=>'==','value'=>'pagination'],
                        ],
                    ],
                ],
             ],
            'navPosition' => [
                'type' => 'string',
                'default' => 'topRight',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationType','condition'=>'==','value'=>'navigation'],
                        ],
                    ],
                ],
            ],
            'pagiAlign' => [
                'type' => 'object',
                'default' =>  (object)['lg' =>'left'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-loadmore, {{WOPB}} .wopb-next-prev-wrap ul, {{WOPB}} .wopb-pagination { text-align:{{pagiAlign}}; }'
                    ],
                ],
            ],
            'pagiTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography' => 1,'size' => (object)['lg' =>14, 'unit' =>'px'],'height' => (object)['lg' =>20, 'unit' =>'px'], 'decoration' => 'none','family'=>''],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pagination li a, {{WOPB}} .wopb-loadmore-action'
                    ],
                ],

            ],
            'pagiArrowSize' => [
                'type' => 'object',
                'default' => (object)['lg'=>'14'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationType','condition'=>'==','value'=>'navigation'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-next-prev-wrap ul li a { font-size:{{pagiArrowSize}}px; }'
                    ],
                ],

            ],
            'pagiColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pagination li a, {{WOPB}} .wopb-next-prev-wrap ul li a, {{WOPB}} .wopb-loadmore-action { color:{{pagiColor}}; } .wopb-next-prev-wrap ul li a svg { fill:{{pagiColor}}; } .wopb-pagination li a svg { fill:{{pagiColor}}; }'
                    ],
                ],
            ],
            'pagiBgColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1, 'type' => 'color', 'color' => '#0e1523'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pagination li a, {{WOPB}} .wopb-next-prev-wrap ul li a, {{WOPB}} .wopb-loadmore-action'
                    ],
                ],
            ],
            'pagiBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pagination li a, {{WOPB}} .wopb-next-prev-wrap ul li a, {{WOPB}} .wopb-loadmore-action'
                    ],
                ],
            ],
            'pagiShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pagination li a, {{WOPB}} .wopb-next-prev-wrap ul li a, {{WOPB}} .wopb-loadmore-action'
                    ],
                ],
            ],
            'pagiRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '2','bottom' => '2','left' => '2','right' => '2', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pagination li a, {{WOPB}} .wopb-next-prev-wrap ul li a, {{WOPB}} .wopb-loadmore-action { border-radius:{{pagiRadius}}; }'
                    ],
                ],
            ],
            'pagiHoverColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pagination li a:hover, {{WOPB}} .wopb-pagination li.pagination-active a, {{WOPB}} .wopb-next-prev-wrap ul li a:hover, {{WOPB}} .wopb-loadmore-action:hover { color:{{pagiHoverColor}}; } {{WOPB}} .wopb-pagination li a:hover svg { fill:{{pagiHoverColor}}; }  {{WOPB}} .wopb-loading-active .wopb-loadmore .wopb-loadmore-action svg { fill:{{pagiHoverColor}}; } {{WOPB}} .wopb-next-prev-wrap ul li a:hover svg { fill:{{pagiHoverColor}}; }'
                    ],
                ],
            ],
            'pagiHoverbg' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1, 'type' => 'color', 'color' => '#ff5845'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pagination li a:hover, {{WOPB}} .wopb-pagination li.pagination-active a, {{WOPB}} .wopb-next-prev-wrap ul li a:hover, {{WOPB}} .wopb-loadmore-action:hover'
                    ],
                ],
            ],
            'pagiHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pagination li a:hover, {{WOPB}} .wopb-pagination li.pagination-active a, {{WOPB}} .wopb-next-prev-wrap ul li a:hover, {{WOPB}} .wopb-loadmore-action:hover'
                    ],
                ],
            ],
            'pagiHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pagination li a:hover, {{WOPB}} .wopb-pagination li.pagination-active a, {{WOPB}} .wopb-next-prev-wrap ul li a:hover, {{WOPB}} .wopb-loadmore-action:hover'
                    ],
                ],
            ],
            'pagiHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '2','bottom' => '2','left' => '2','right' => '2', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pagination li a:hover, {{WOPB}} .wopb-next-prev-wrap ul li a:hover, {{WOPB}} .wopb-loadmore-action:hover { border-radius:{{pagiHoverRadius}}; }'
                    ],
                ],
            ],
            'pagiPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '8','bottom' => '8','left' => '14','right' => '14', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationShow','condition'=>'==','value'=>true],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pagination li a, {{WOPB}} .wopb-next-prev-wrap ul li a, {{WOPB}} .wopb-loadmore-action { padding:{{pagiPadding}}; }'
                    ],
                ],
            ],
            'navMargin' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationType','condition'=>'==','value'=>'navigation'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-next-prev-wrap ul { margin:{{navMargin}}; }'
                    ],
                ],
            ],
            'pagiMargin' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '30', 'right' => '0', 'bottom' => '0', 'left' => '0', 'unit' =>'px']],
                'style' => [
                    (object)[
                        'depends' => [
                            (object)['key'=>'paginationType','condition'=>'!=','value'=>'navigation'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-pagination, {{WOPB}} .wopb-loadmore { margin:{{pagiMargin}}; }'
                    ],
                ],
            ],
        

            //--------------------------
            //  Wrapper Style
            //--------------------------
            'wrapBg' => [
                'type' => 'object',
                'default' => (object)['openColor' => 0, 'type' => 'color', 'color' => '#f5f5f5'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-block-wrapper'
                    ],
                ],
            ],
            'wrapBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' =>(object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-block-wrapper'
                    ],
                ],
            ],
            'wrapShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-block-wrapper'
                    ],
                ],
            ],
            'wrapRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-block-wrapper { border-radius:{{wrapRadius}}; }'
                    ],
                ],
            ],
            'wrapHoverBackground' => [
                'type' => 'object',
                'default' => (object)['openColor' => 0, 'type' => 'color', 'color' => '#ff5845'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-block-wrapper:hover'
                    ],
                ],
            ],
            'wrapHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-block-wrapper:hover'
                    ],
                ],
            ],
            'wrapHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-block-wrapper:hover { border-radius:{{wrapHoverRadius}}; }'
                    ],
                ],
            ],
            'wrapHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-block-wrapper:hover'
                    ],
                ],
            ],
            'wrapMargin' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '', 'unit' =>'px']],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-block-wrapper { margin:{{wrapMargin}}; }'
                    ],
                ],
            ],
            'wrapOuterPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '','left' => '', 'right' => '', 'unit' =>'px']],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-block-wrapper { padding:{{wrapOuterPadding}}; }'
                    ],
                ],
            ],
            'wrapInnerPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['unit' =>'px']],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-block-wrapper { padding:{{wrapInnerPadding}}; }'
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
        register_block_type( 'product-blocks/product-grid-2',
            array(
                'title' => __('Product Grid #2', 'product-blocks'),
                'attributes' => $this->get_attributes(),
                'render_callback' =>  array($this, 'content')
            ));
    }

    public function content($attr, $noAjax = false) {

        if(!$noAjax){
            $paged = is_front_page() ? get_query_var('page') : get_query_var('paged');
            $attr['paged'] = $paged ? $paged : 1;
        }

        $block_name = 'product-grid-2';
        $page_post_id = wopb_function()->get_ID();
        $wraper_before = $wraper_after = $post_loop = '';
        $recent_posts = new \WP_Query( wopb_function()->get_query( $attr ) );
        $pageNum = wopb_function()->get_page_number($attr, $recent_posts->found_posts);

        $wishlist = wopb_function()->get_setting('wopb_wishlist') == 'true' ? true : false;
        $wishlist_data = $wishlist ? wopb_function()->get_wishlist_id() : array();
        $compare = wopb_function()->get_setting('wopb_compare') == 'true' ? true : false;
        $compare_data = $compare ? wopb_function()->get_compare_id() : array();

        $slider_attr = wc_implode_html_attributes(
            array(
                'data-slidestoshow'  => wopb_function()->slider_responsive_split($attr['slidesToShow']),
                'data-autoplay'      => $attr['autoPlay'],
                'data-slidespeed'    => $attr['slideSpeed'],
                'data-showdots'      => $attr['showDots'],
                'data-showarrows'    => $attr['showArrows']
            )
        );
    
        if ($recent_posts->have_posts()) {
            
            $wraper_before .= '<div '.($attr['advanceId']?'id="'.$attr['advanceId'].'" ':'').' class="wp-block-product-blocks-'.$block_name.' wopb-block-'.$attr["blockId"].' '.(isset($attr["className"])?$attr["className"]:'').'">';
                $wraper_before .= '<div class="wopb-block-wrapper">';

                    if ($attr['headingShow'] || $attr['filterShow']) {
                        $wraper_before .= '<div class="wopb-heading-filter">';
                            $wraper_before .= '<div class="wopb-heading-filter-in">';
                                
                                // Heading
                                include WOPB_PATH.'blocks/template/heading.php';
                                
                                if ( ($attr['filterShow'] ) && $attr['productView'] == 'grid' ) {
                                    $wraper_before .= '<div class="wopb-filter-navigation">';
                                        if($attr['filterShow']) {
                                            include WOPB_PATH.'blocks/template/filter.php';
                                        }
                                    $wraper_before .= '</div>';
                                }

                            $wraper_before .= '</div>';
                        $wraper_before .= '</div>';
                    }
             
                    if ( $attr['productView'] == 'slide' ) {
                        $wraper_before .= '<div class="wopb-product-blocks-slide" '.$slider_attr.'>';
                    } else {
                        $wraper_before .= '<div class="wopb-block-items-wrap wopb-block-row wopb-block-column-'.json_decode(json_encode($attr['columns']), True)['lg'].'">';
                    }
                    
                        $idx = $noAjax ? 1 : 0;
                        while ( $recent_posts->have_posts() ): $recent_posts->the_post();

                            $image_data = $category_data = $title_data = $price_data = $review_data = $cart_data = $content_data = '';

                            include WOPB_PATH.'blocks/template/data.php';

                            include WOPB_PATH.'blocks/template/category.php';
                            
                            $post_loop .= '<div class="wopb-block-item">';
                                $post_loop .= '<div class="wopb-block-content-wrap '.($attr['layout']?'wopb-pg-l'.$attr['layout']:'').'">';
                                    // Image
                                    if ($attr['showImage']) {
                                        $image_data .= '<div class="wopb-block-image wopb-block-image-'.$attr['imgAnimation'].'">';

                                            if( $attr["showSale"] || $attr["showHot"] ) {
                                                $image_data .= '<div class="wopb-onsale-hot">';
                                                    if( $attr["showSale"] && $_sales && $_regular && $product->is_on_sale() ) {
                                                        $image_data .= '<span class="wopb-onsale wopb-onsale-'.$attr["saleStyle"].'">';
                                                            if($attr["saleDesign"] == 'digit') { $image_data .= '-' . $_discount; }
                                                            if($attr["saleDesign"] == 'text') { $image_data .= isset($attr["saleText"]) ? $attr["saleText"] : __('Sale!', 'product-blocks'); }
                                                            if($attr["saleDesign"] == 'textDigit') { $image_data .= '-' . $_discount . __(' Off', 'product-blocks'); }
                                                        $image_data .= '</span>';
                                                    }
                                                    if( $attr["showHot"] && $product->is_featured() ) {
                                                        $image_data .= '<span class="wopb-hot">';
                                                            $image_data .= isset($attr["hotText"]) ? $attr["hotText"] : __('Hot', 'product-blocks');
                                                        $image_data .= '</span>';
                                                    }
                                                $image_data .= '</div>';
                                            }

                                            if ( $attr["quickView"] || $attr["showCompare"] || $attr["showWishList"] || $attr["showCart"] ) {
                                            $image_data .= '<div class="wopb-product-meta">';
                                                if( $wishlist ) {
                                                    if( ( $attr["layout"] == '1' || $attr["layout"] == '2' ) && $attr["showWishList"] ) {
                                                        $image_data .= wopb_function()->get_wishlist_html($post_id, $wishlist_active, $attr["layout"], array(1, 2));
                                                    }
                                                }
                                                if( $attr["layout"] == '3' || $attr["layout"] == '4' || $attr["layout"] == '5' || $attr["layout"] == '6' ) {
                                                    if( $wishlist ) {
                                                        if( ( $attr["layout"] == '3' || $attr["layout"] == '4' || $attr["layout"] == '5' || $attr["layout"] == '6' ) && $attr["showWishList"] ) {
                                                            $image_data .= wopb_function()->get_wishlist_html($post_id, $wishlist_active, $attr["layout"], array(3, 4));
                                                        }
                                                    }
                                                    if( $attr["quickView"] ) {
                                                        $image_data .= wopb_function()->get_quickview($recent_posts, $post_id, $attr['layout'], array(3, 4), true);
                                                    }
                                                    if( $attr["showCompare"] ) {
                                                        $image_data .= wopb_function()->get_compare($post_id, $compare_active, $attr["layout"], array(3, 4));
                                                    }
                                                    if( ( $attr["layout"] == '4' || $attr["layout"] == '5' || $attr["layout"] == '6' ) && $attr["showCart"] ) {
                                                        $image_data .= wopb_function()->get_add_to_cart($product, $attr['cartText'], $attr['cartActive'], $attr['layout'], array(3, 4));
                                                    }
                                                }
                                            $image_data .= '</div>';
                                            }

                                            if ($attr["showDeal"]) {
                                                $image_data .= wopb_function()->get_deals($product, $attr["dealText"]);
                                            }

                                            if( ($attr['catPosition'] != 'none') && $attr['catShow']) {
                                                $image_data .= '<div class="wopb-category-img-grid">'.$category.'</div>';
                                            }

                                            if ( ($product->get_stock_status() == 'outofstock' ) && $attr["showOutStock"] ) {
                                                $image_data .= '<div class="wopb-product-outofstock">';
                                                    $image_data .= '<span>'.__( "Out of stock", "product-blocks" ).'</span>';
                                                $image_data .= '</div>';
                                            }elseif ( ($product->get_stock_status() == 'instock' ) && $attr["showInStock"] ) {
                                                $image_data .= '<div class="wopb-product-instock">';
                                                    $image_data .= '<span>'.__( "In Stock", "product-blocks" ).'</span>';
                                                $image_data .= '</div>';
                                            }

                                            // Image
                                            if (has_post_thumbnail()) {
                                                $image_data .= '<a href="'.$titlelink.'"><img alt="'.esc_attr($title).'" src="'.wp_get_attachment_image_url( $post_thumb_id, ($attr['imgCrop'] ? $attr['imgCrop'] : 'full') ).'" />';
                                                    if ( $attr['showFlip']) {
                                                        $image_data .= wopb_function()->get_flip_image($post_id, $title, $attr['imgCrop']);
                                                    }
                                                $image_data .= '</a>';
                                            } else {
                                                $image_data .='<div class="empty-image">';
                                                    $image_data .= '<a href="'.$titlelink.'">';
                                                        $image_data .='<img alt='.esc_attr($title).' src="'.wc_placeholder_img_src(($attr['imgCrop'] ? $attr['imgCrop'] : 'full')).'"/>';
                                                    $image_data .= '</a>';
                                                $image_data .='</div>';
                                            }
                                            
                                        $image_data .= '</div>';
                                    }
                                    
                                    $content_data .= '<div class="wopb-product-grid3-overlay"></div>';
                                    $content_data .= '<div class="wopb-product-grid3-content">';
                                        // Title
                                        if($attr['titleShow']){
                                            include WOPB_PATH.'blocks/template/title.php';
                                            $content_data .= $title_data;
                                        }
                                        // Category
                                        if(($attr['catPosition'] == 'none') && $attr['catShow']){
                                            $content_data .= $category;
                                        }
                                        // Price
                                        if($attr['showPrice']){
                                            $content_data .= '<div class="wopb-product-price">'.$product->get_price_html().'</div>';
                                        }
                                        $content_data .= '<div class="wopb-fade-in-block">';
                                            // Review
                                            if($attr['showReview']){
                                                include WOPB_PATH.'blocks/template/review.php';
                                                $content_data .= $review_data;
                                            }
                                            if($attr['showShortDesc']){
                                                $content_data .= '<div class="wopb-short-description">'. wopb_function()->excerpt($post_id, $attr['shortDescLimit']) .'</div>';
                                            }

                                            if( $attr["layout"] == '1' || $attr["layout"] == '2' || $attr["layout"] == '3' ) {
                                                $content_data .= '<div class="wopb-quick-cart wopb-grid3-quick-cart">';
                                                    // Add to Cart URL
                                                    if( ( $attr["layout"] == '1' || $attr["layout"] == '3' ) && $attr['showCart']) {
                                                        $content_data .= wopb_function()->get_add_to_cart($product, $attr['cartText']);
                                                    }    
                                                    if ( $attr["layout"] == '2' ) {
                                                        if( $attr["quickView"] ) {
                                                            $content_data .= '<div class="wopb-quickview-btn">';
                                                                $content_data .= wopb_function()->get_quickview($recent_posts, $post_id, $attr['layout'], array(1, 2, 3, 4), true);
                                                            $content_data .= '</div>';
                                                        }
                                                        if($attr['showCart']){
                                                            $content_data .= wopb_function()->get_add_to_cart($product, $attr['cartText']);
                                                        }  
                                                        if( $attr["showCompare"] ) {
                                                            $content_data .= '<div class="wopb-compare-btn">';
                                                                $content_data .= wopb_function()->get_compare($post_id, $compare_active, $attr["layout"], array(3, 4));
                                                            $content_data .= '</div>';
                                                        }
                                                    }
                                                $content_data .= '</div>';
                                            }
                                        $content_data .= '</div>';
                                    $content_data .= '</div>';
                                    
                                    $post_loop .= $image_data.$content_data;

                                $post_loop .= '</div>';
                            $post_loop .= '</div>';
                            $idx ++;
                        endwhile;


                        if($attr['paginationShow'] && $attr['productView'] == 'grid' && ($attr['paginationType'] == 'loadMore')) {
                            $wraper_after .= '<span class="wopb-loadmore-insert-before"></span>';
                        }
                    $wraper_after .= '</div>';//wopb-block-items-wrap
                    
                    // Load More
                    if ($attr['paginationShow'] && $attr['productView'] == 'grid' && ($attr['paginationType'] == 'loadMore')) {
                        include WOPB_PATH.'blocks/template/loadmore.php';
                    }

                    // Pagination
                    if ($attr['paginationShow'] && $attr['productView'] == 'grid' && ($attr['paginationType'] == 'pagination')) {
                        include WOPB_PATH.'blocks/template/pagination.php';
                    }

                    if($attr['showArrows']){
                        include WOPB_PATH.'blocks/template/arrow.php';   
                    }

                $wraper_after .= '</div>';
            $wraper_after .= '</div>';

            wp_reset_query();
        }

        return $noAjax ? $post_loop : $wraper_before.$post_loop.$wraper_after;
    }

}