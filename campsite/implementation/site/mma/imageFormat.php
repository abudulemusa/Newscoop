<?php
/**
 * @author $Author: holman $
 *
 */

$imageFormat = array(
    '_root'=>'image',
    'image'=>array(
        'childs'=>array(
            'required'=>array('metadata'),
        ),
    ),
    'metadata'=>array(
        'childs'=>array(
            'required'=>array(
                'dc:title'
            ),
            'optional'=>array(
		'dc:identifier',
	        'dc:format','dc:description','dc:maker','dc:maker_model',
		'dc:date_time','ls:filename','ls:filesize','ls:filetype',
		'ls:image_width','ls:image_height','ls:bitspersample',
		'ls:mtime', 'ls:photographer', 'ls:place', 'ls:url'
	    ),
        ),
        'namespaces'=>array(
            'dc'=>"http://purl.org/dc/elements/1.1/",
            'dcterms'=>"http://purl.org/dc/terms/",
            'xbmf'=>"http://www.streamonthefly.org/xbmf",
            'xsi'=>"http://www.w3.org/2001/XMLSchema-instance",
            'xml'=>"http://www.w3.org/XML/1998/namespace",
        ),
    ),
    'dc:identifier'=>array(
        'type'=>'Text',
        'auto'=>TRUE,
    ),
    'dc:title'=>array(
        'type'=>'Text',
        'attrs'=>array('implied'=>array('xml:lang')),
    ),
    'dc:description'=>array(
        'type'=>'Longtext',
        'area'=>'Image',
        'attrs'=>array('implied'=>array('xml:lang')),
    ),
    'dc:maker'=>array(
        'type'=>'Text',
        'area'=>'Image',
        'attrs'=>array('implied'=>array('xml:lang')),
    ),
    'dc:maker_model'=>array(
        'type'=>'Text',
        'area'=>'Image',
        'attrs'=>array('implied'=>array('xml:lang')),
    ),
    'dc:date_time'=>array(
        'type'=>'Date',
        'area'=>'Image',
        'attrs'=>array('implied'=>array('xml:lang')),
    ),
    'dc:format'=>array(
        'type'=>'Menu',
        'area'=>'Music',
        'attrs'=>array('implied'=>array('xml:lang')),
    ),
    'ls:image_width'=>array(
        'type'=>'Int',
        'area'=>'Image',
        'attrs'=>array('implied'=>array('xml:lang')),
    ),
    'ls:image_height'=>array(
        'type'=>'Int',
        'area'=>'Image',
        'attrs'=>array('implied'=>array('xml:lang')),
    ),
    'ls:bitspersample'=>array(
        'type'=>'Int',
        'area'=>'Image',
        'attrs'=>array('implied'=>array('xml:lang')),
    ),
    'ls:filename'=>array(
        'type'=>'Text',
        'attrs'=>array('implied'=>array('xml:lang')),
    ),
    'ls:filesize'=>array(
	'type'=>'Int',
	'attrs'=>array('implied'=>array('xml:lang')),
    ),
    'ls:filetype'=>array(
	'type'=>'Text',
	'attrs'=>array('implied'=>array('xml:lang')),
    ),
    'ls:mtime'=>array(
        'type'=>'Int',
//        'regexp'=>'^\d{4}(-\d{2}(-\d{2}(T\d{2}:\d{2}(:\d{2}\.\d+)?(Z)|([\+\-]?\d{2}:\d{2}))?)?)?$',
    ),
    'ls:photographer'=>array(
        'type'=>'Text'
    ),
    'ls:place'=>array(
        'type'=>'Text'
    ),
    'ls:url'=>array(
        'type'=>'Text'
    )
);

?>