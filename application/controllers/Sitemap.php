<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller  {

    function index()
    {
        $product_list =
            $this->db->from('tbl_site_category')
                ->select('sca_key')
                ->where('sca_depth','0')
                ->order_by('sca_sort ASC')
                ->get()
                ->result_array();
        $board_list =
            $this->db->from('tbl_board')
                ->get()
                ->result_array();

        ob_start();

        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n";
        echo "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        echo "<sitemap>".PHP_EOL;
        echo "<loc>".base_url("sitemap_about.xml")."</loc>".PHP_EOL;
        echo "</sitemap>\n";

        foreach($product_list as $product)
        {
            if($product['sca_key'] == 'eur') continue;
            echo "<sitemap>\n";
            echo "<loc>".base_url("sitemap_product_".$product['sca_key'].".xml")."</loc>\n";
            echo "</sitemap>\n";
        }

        foreach($board_list as $board)
        {
            echo "<sitemap>\n";
            echo "<loc>".base_url("sitemap_board_".$board['brd_key'].".xml")."</loc>\n";
            echo "</sitemap>\n";
        }

        echo "</sitemapindex>\n";

        $xml = ob_get_clean();

        $this->output
            ->set_content_type('text/xml')
            ->set_header('Cache-control', 'no-cache, must-revalidate')
            ->set_header('Pragma','no-cache')
            ->set_output($xml);
    }

    function about()
    {
        $branch_list =
            $this->db->from('tbl_site_branch')
                 ->order_by("bnc_sort ASC")
                 ->get()
                 ->result_array();

        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n";
        echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        echo "<url>".PHP_EOL;
        echo "<loc>".base_url("about")."</loc>".PHP_EOL;
        echo "<lastmod>".date('Y-m-d', filemtime(VIEWPATH."desktop/about/index.php"))."</lastmod>".PHP_EOL;
        echo "<priority>0.9</priority>".PHP_EOL;
        echo "<changefreq>monthly</changefreq>".PHP_EOL;
        echo "</url>".PHP_EOL;

        foreach($branch_list as $branch)
        {
            echo "<url>".PHP_EOL;
            echo "<loc>".base_url("about/branch/".urlencode($branch['bnc_name']))."</loc>".PHP_EOL;
            echo "<lastmod>2016-11-05</lastmod>".PHP_EOL;
            echo "<priority>0.9</priority>".PHP_EOL;
            echo "<changefreq>monthly</changefreq>".PHP_EOL;
            echo "</url>".PHP_EOL;
        }

        echo "<url>".PHP_EOL;
        echo "<loc>".base_url("about/agreement")."</loc>".PHP_EOL;
        echo "<lastmod>".date('Y-m-d', filemtime(VIEWPATH."desktop/about/agreement.php"))."</lastmod>".PHP_EOL;
        echo "<priority>0.9</priority>".PHP_EOL;
        echo "<changefreq>monthly</changefreq>".PHP_EOL;
        echo "</url>".PHP_EOL;

        echo "<url>".PHP_EOL;
        echo "<loc>".base_url("about/privacy")."</loc>".PHP_EOL;
        echo "<lastmod>".date('Y-m-d', filemtime(VIEWPATH."desktop/about/privacy.php"))."</lastmod>".PHP_EOL;
        echo "<priority>0.9</priority>".PHP_EOL;
        echo "<changefreq>monthly</changefreq>".PHP_EOL;
        echo "</url>".PHP_EOL;

        echo "<url>".PHP_EOL;
        echo "<loc>".base_url("about/travel")."</loc>".PHP_EOL;
        echo "<lastmod>".date('Y-m-d', filemtime(VIEWPATH."desktop/about/travel.php"))."</lastmod>".PHP_EOL;
        echo "<priority>0.9</priority>".PHP_EOL;
        echo "<changefreq>monthly</changefreq>".PHP_EOL;
        echo "</url>".PHP_EOL;

        echo "</urlset>".PHP_EOL;

        $xml = ob_get_clean();
        $this->output
            ->set_content_type('text/xml')
            ->set_header('Cache-control', 'no-cache, must-revalidate')
            ->set_header('Pragma','no-cache')
            ->set_output($xml);
    }

    function board($brd_key)
    {
        $post_list =
            $this->db->from('tbl_board_post')
                 ->where('brd_key', $brd_key)
                 ->where('post_depth','0')
                 ->where('post_status','Y')
                 ->order_by('post_idx DESC')
                 ->get()
                 ->result_array();

        ob_start();

        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n";
        echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        foreach($post_list as $post)
        {
            echo "<url>\n";
            echo "    <loc>".base_url("board/{$post['brd_key']}/{$post['post_idx']}") . "</loc>".PHP_EOL;
            echo "    <lastmod>". date('Y-m-d', strtotime($post['post_modtime'])) ."</lastmod>".PHP_EOL;
            echo "</url>\n";
        }

        echo "</urlset>".PHP_EOL;
        $xml = ob_get_clean();

        $this->output
            ->set_content_type('text/xml')
            ->set_header('Cache-control', 'no-cache, must-revalidate')
            ->set_header('Pragma','no-cache')
            ->set_output($xml);
    }

    function product($sca_key)
    {
        $product_list =
            $this->db->from('tbl_site_product AS S')
                ->select("S.sca_parent,S.sca_key,S.prd_idx,P.images, P.captions")
                ->join('(SELECT GROUP_CONCAT(gll_path SEPARATOR \'|\') AS images, GROUP_CONCAT(gll_title SEPARATOR \'|\') AS captions, prd_idx FROM tbl_product_gallery GROUP BY prd_idx) AS P',"P.prd_idx=S.prd_idx","left")
                ->where('S.sca_parent', $sca_key)
                ->order_by('S.prd_sort ASC')
                ->get()
                ->result_array();

        ob_start();

        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n";
        echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:image=\"http://www.google.com/schemas/sitemap-image/1.1\">\n";

        foreach($product_list as $product)
        {
            $images = explode("|", $product['images']);
            $captions = explode("|", $product['captions']);

            echo "<url>\n";
            echo "    <loc>" . base_url("products/{$product['sca_parent']}/{$product['sca_key']}/{$product['prd_idx']}") . "</loc>\n";

            foreach($images as &$img)
            {
                if(empty($img)) unset($img);
            }

            $str = "";
            for($i=0; $i<count($images); $i++)
            {
                if( empty($images[$i]) OR empty($captions[$i]) ) continue;
                $str .= '<image:image>'.PHP_EOL;
                $str .= '        <image:loc>'. base_url($images[$i]) . '</image:loc>'.PHP_EOL;
                $str .= '        <image:caption>'.htmlspecialchars($captions[$i]).'</image:caption>'.PHP_EOL;
                $str .= '</image:image>'.PHP_EOL;
            }

            if(! empty($str))
            {
                echo $str;
            }

            echo "</url>\n";
        }
        echo "</urlset>".PHP_EOL;
        $xml = ob_get_clean();

        $this->output
            ->set_content_type('text/xml')
            ->set_header('Cache-control', 'no-cache, must-revalidate')
            ->set_header('Pragma','no-cache')
            ->set_output($xml);
    }

    function rss()
    {
        $post_list =
            $this->db->from('tbl_board_post')
                ->where_in('brd_key', array('article','trstory'))
                ->where('post_depth','0')
                ->where('post_status','Y')
                ->order_by('post_idx DESC')
                ->limit(50)
                ->get()
                ->result_array();

        ob_start();

        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?".">".PHP_EOL;
        echo "<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">".PHP_EOL;
        echo "<channel>".PHP_EOL;
        echo "    <title>천생연분 닷컴 소식지</title>".PHP_EOL;
        echo "    <link>".base_url()."</link>".PHP_EOL;
        echo "    <atom:link href=\"".base_url("rss")."\" rel=\"self\" type=\"application/rss+xml\" />".PHP_EOL;
        echo "    <copyright><![CDATA[천생연분닷컴]]></copyright>".PHP_EOL;
        echo "    <description><![CDATA[천생연분닷컴 소식지]]></description>".PHP_EOL;
        foreach($post_list as $post)
        {
            $category = $post['brd_key'] == 'article' ? '보도자료' : '고객후기';
            echo "    <item>".PHP_EOL;
            echo "        <title><![CDATA[(" . $category .') '. html_entity_decode($post['post_title']) . "]]></title>".PHP_EOL;
            echo "        <link>" . base_url("board/{$post['brd_key']}/{$post['post_idx']}") . "</link>".PHP_EOL;
            echo "        <author>" . ($post['brd_key'] == 'article' ? '천생연분닷컴' : htmlspecialchars($post['usr_name'])) . "</author>".PHP_EOL;
            echo "        <pubDate>" .  date(DATE_RSS, strtotime($post['post_regtime'])) . "</pubDate>".PHP_EOL;
            echo "        <description><![CDATA[" . html_entity_decode(strip_tags(htmlspecialchars_decode($post['post_content']))). "]]></description>".PHP_EOL;
            echo "        <category>{$category}</category>".PHP_EOL;
            echo "    </item>".PHP_EOL;
        }
        echo "</channel>".PHP_EOL;
        echo "</rss>".PHP_EOL;
        $xml = ob_get_clean();
        $this->output
            ->set_content_type('text/xml')
            ->set_header('Cache-control', 'no-cache, must-revalidate')
            ->set_header('Pragma','no-cache')
            ->set_output($xml);
    }
}