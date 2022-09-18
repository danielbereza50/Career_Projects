<?php
/*
    Plugin Name: Cache Buster
    Plugin URI:  //
    Description: BareBones template for standard plugin
    Version:     100.0.0
    Author:      Daniel Bereza 
    Author URI:  //
    License:     GPL2
    License URI: Licence URl
*/


// debugging
// echo "$variable_name"; WP_DEBUG; var_dump(); print_r(); error_log(); debug_backtrace();

// Imports
// include ('includes/class1.php');
// include ('includes/class1.php');

/*

<script>
  window.onload = () => {
    document.querySelectorAll(".csv").forEach(link =>
      link.href += "?v=" + Math.random()
    );
  };
</script>

*/

function defer_parsing_of_js( $url ) {
    if (is_user_logged_in() ) return $url; //don't break WP Admin
    if ( FALSE === strpos( $url, '.js' ) ) return $url;
    if ( strpos( $url, 'jquery.js' ) ) return $url;
    return str_replace( ' src', ' defer src', $url );
}
add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10 );


class cachebuster {
	
    protected $flhm_compress_css = true;
    protected $flhm_compress_js = false;
    protected $flhm_info_comment = true;
    protected $flhm_remove_comments = true;
    protected $html;

    public function __construct($html) {
        if (!empty($html)) {
            $this->flhm_parseHTML($html);
        }
    }
    public function init() {
        add_action('get_header', array($this, 'flhm_wp_html_compression_start'));
    }

    public function __toString() {
        return $this->html;
    }
    protected function flhm_bottomComment($raw, $compressed) {
        $raw = strlen($raw);
        $compressed = strlen($compressed);
        $savings = ($raw - $compressed) / $raw * 100;
        $savings = round($savings, 2);
        return '<!--HTML compressed, size saved ' . $savings . '%. From ' . $raw . ' bytes, now ' . $compressed . ' bytes-->';
    }
    protected function flhm_minifyHTML($html) {
        $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
        preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
        $overriding = false;
        $raw_tag = false;
        $html = '';
        foreach ($matches as $token) {
            $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
            $content = $token[0];
            if (is_null($tag)) {
                if (!empty($token['script'])) {
                    $strip = $this->flhm_compress_js;
                } else if (!empty($token['style'])) {
                    $strip = $this->flhm_compress_css;
                } else if ($content == '<!--wp-html-compression no compression-->') {
                    $overriding = !$overriding;
                    continue;
                } else if ($this->flhm_remove_comments) {
                    if (!$overriding && $raw_tag != 'textarea') {
                        $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
                    }
                }
            } else {
                if ($tag == 'pre' || $tag == 'textarea') {
                    $raw_tag = $tag;
                } else if ($tag == '/pre' || $tag == '/textarea') {
                    $raw_tag = false;
                } else {
                    if ($raw_tag || $overriding) {
                        $strip = false;
                    } else {
                        $strip = true;
                        $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
                        $content = str_replace(' />', '/>', $content);
                    }
                }
            }
            if ($strip) {
                $content = $this->flhm_removeWhiteSpace($content);
            }
            $html.= $content;
        }
        return $html;
    }
    public function flhm_parseHTML($html) {
        $this->html = $this->flhm_minifyHTML($html);
        if ($this->flhm_info_comment) {
            $this->html.= "\n" . $this->flhm_bottomComment($html, $this->html);
        }
    }
    protected function flhm_removeWhiteSpace($str) {
        $str = str_replace("\t", ' ', $str);
        $str = str_replace("\n", '', $str);
        $str = str_replace("\r", '', $str);
        while (stristr($str, '  ')) {
            $str = str_replace('  ', ' ', $str);
        }
        return $str;
    }
    public function flhm_wp_html_compression_start() {
        ob_start('flhm_wp_html_compression_finish');
    }
} // end of class
$obj = new cachebuster($html);
$obj->init();
function flhm_wp_html_compression_finish($html) {
    return new cachebuster($html);
}








