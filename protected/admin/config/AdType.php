<?php
return array(
    'img'=>array(
        'name'=>'图片',
        'dom'=>array(
            array(
                'type'=>'div',
                'attr'=>array(
                    'class'=>'unit',
                ),
                'child'=>array(
                    array(
                    	'label'=>'图片',
                        'type'=>'file',
                        'attr'=>array(
                        	'name'=>'src',
                        ),
                        'css'=>array(
                            'width'=>'140px',
                        ),
                    ),
                ),
            ),
            array(
                'type'=>'div',
                'attr'=>array(
                    'class'=>'unit',
                ),
                'child'=>array(
                    array(
                        'label'=>'图片尺寸',
                        'type'=>'text',
                    	'attr'=>array(
                        	'name'=>'Form[param][width]',
                            'class'=>'textInput',
                        ),
                        'css'=>array(
                            'width'=>'50px',
                        ),
                    ),
                    array(
                        'type'=>'split',
                    	'text'=>'×',
                        'css'=>array(
                            'float'=>'left',
                            'width'=>'15px',
                            'height'=>'21px',
                            'line-height'=>'21px',
                            'text-align'=>'center',
                        ),
                    ),
                    array(
                        'type'=>'text',
                        'attr'=>array(
                        	'name'=>'Form[param][height]',
                            'class'=>'textInput',
                        ),
                        'css'=>array(
                            'width'=>'50px',
                        ),
                    ),
                ),
            ),
            array(
                'type'=>'div',
                'attr'=>array(
                    'class'=>'unit',
                ),
                'child'=>array(
                    array(
                        'label'=>'链接地址',
                        'type'=>'text',
                        'attr'=>array(
                        	'name'=>'Form[param][href]',
                            'class'=>'textInput required',
                            'alt'=>'链接地址必填',
                        ),
                    ),
                ),
            ),
            array(
                'type'=>'div',
                'attr'=>array(
                    'class'=>'unit',
                ),
                'child'=>array(
                    array(
                        'label'=>'打开方式',
                        'type'=>'text',
                        'attr'=>array(
                        	'name'=>'Form[param][target]',
                            'class'=>'textInput',
                        ),
                    ),
                ),
            ),
        ),
    ),
    'link'=>array(
        'name'=>'链接',
        'dom'=>array(
            array(
                'type'=>'div',
                'attr'=>array(
                    'class'=>'unit',
                ),
                'child'=>array(
                    array(
                        'label'=>'链接文字',
                        'type'=>'text',
                        'attr'=>array(
                        	'name'=>'Form[param][text]',
                            'class'=>'textInput required',
                            'alt'=>'链接文字必填',
                        ),
                    ),
                ),
            ),
            array(
                'type'=>'div',
                'attr'=>array(
                    'class'=>'unit',
                ),
                'child'=>array(
                    array(
                        'label'=>'链接地址',
                        'type'=>'text',
                        'attr'=>array(
                        	'name'=>'Form[param][href]',
                            'class'=>'textInput required',
                            'alt'=>'链接地址必填',
                        ),
                    ),
                ),
            ),
        ),
    ),
);
?>