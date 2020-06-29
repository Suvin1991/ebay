<?php

require_once 'simple_html_dom.php';

/**
 *
 */
class DomScrapper
{

    public $ids;
    public $result;
    public $fields;
    public $parser;
    public $html;
    public $urlFormat;

    public function __construct($ids = [])
    {

        $this->result = [];
        $this->fields = [
            'title'       => '',
            'imageSrc'    => '',
            'publicUrl'   => '',
            'otherImages' => [],
        ];
        $this->parser    = new simple_html_dom();
        $this->urlFormat = 'https://www.ebay.com/itm/';

        if (isset($ids) && !empty($ids)) {
            $this->ids = $ids;
            $this->process();
        }

    }

    public function process($ids = [])
    {
        if (isset($ids) && !empty($ids)) {
            $this->ids = $ids;
        }

        foreach ($this->ids as $id) {
            $data = $this->fetchDetails($id);
            if ($data) {
                $this->result[$id] = $data;
            }
        }
    }

    public function fetchDetails($id)
    {
        $returnSet = $this->fields;

        $url = $this->urlFormat . $id;

        try {
            $dom = file_get_html($url);
        } catch(Exception $e) {}
        if ($dom) {

            $returnSet['publicUrl'] = $url;

            $title = $this->fetchTitle($dom);
            if ($title) {
                $returnSet['title'] = $title;
            }

            $imgSrc = $this->fetchImageSrc($dom);
            if ($imgSrc) {
                $returnSet['imageSrc'] = $imgSrc;
            }

            $returnSet['otherImages'] = $this->fetchSecondaryImages($dom);

            $dom->clear();
            unset($dom);

            return $returnSet;
        }

    }

    public function fetchTitle($dom)
    {
        $title = $dom->find('h1[id=itemTitle]', 0)->plaintext;

        return (isset($title) && !empty($title)) ? $title : false;
    }

    public function fetchImageSrc($dom)
    {
        $imgSrc = (isset($dom->find('div[id=mainImgHldr] img[id=icThrImg]', 0)->src) && !empty($dom->find('div[id=mainImgHldr] img[id=icThrImg]', 0)->src)) ? $dom->find('div[id=mainImgHldr] img[id=icThrImg]', 0)->src : false;
        return $imgSrc;
    }

    public function fetchSecondaryImages($dom)
    {
        $images = [];
        $imgLi  = $dom->find('div#vi_main_img_fs_slider ul.lst li');
        foreach ($imgLi as $key => $val) {
            $imgSrc = (isset($val->find('img', 0)->src) && !empty($val->find('img', 0)->src)) ? $val->find('img', 0)->src : false;
            if ($imgSrc && !in_array($imgSrc, $images)) {
                $images[] = $imgSrc;
            }
        }
        return $images;
    }

}
