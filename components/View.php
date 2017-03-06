<?php

namespace app\components;

use app\helpers\Url;
use app\models\Config;
use Yii;
use yii\web\View as BaseView;

/**
 * @author Hendri <hendri.gnw@gmail.com>
 */
class View extends BaseView {

    /**
     * Use this function to insert javascript from view. Make sure you put $this->endBlock() at the end of your script.
     * For example:
     *
     * <?php $this->beginJsBlock() ?>
     *     <script>
     *         // your script goes here
     *     </script>
     * <?php $this->endBlock() ?>
     */
    public function beginJsBlock() {
        Yii::$app->params['jsBlock'] += 1;

        $this->beginBlock('jsBlock' . Yii::$app->params['jsBlock']);
    }

    /**
     * Use this function to insert modal from view. Make sure you put $this->endBlock() at the end of your modal.
     * For example:
     *
     * <?php $this->beginModalBlock() ?>
     *     // your modal goes here
     * <?php $this->endBlock() ?>
     */
    public function beginModalBlock() {
        Yii::$app->params['modalBlock'] += 1;

        $this->beginBlock('modalBlock' . Yii::$app->params['modalBlock']);
    }

    /**
     * Finds the view file based on the given view name. Refer to parent::findViewFile() for full documentation.
     * This function basically here just to make parent::findViewFile() public. Original visibility is protected.
     *
     * @param string $view
     * @param object $context
     * @return string the view file path. Note that the file may not exist.
     */
    public function findViewFile($view, $context = null) {
        return parent::findViewFile($view, $context);
    }

    public function registerLinkAlternate($key = null) {
        $this->registerLinkTag([
            'rel' => 'alternate',
            'media' => 'only screen and (max-width: 640px)',
            'href' => Yii::$app->params['mobileUrl'] . Yii::$app->request->url,
                ], $key);
    }

    public function registerLinkCanonical($key = null) {
        $this->registerLinkTag(['rel' => 'canonical', 'href' => Url::canonical()], $key);
    }

    public function registerMetaTitle($content = null, $key = null) {
        $this->registerMetaTag([
            'name' => 'title',
            'content' => ($content != null) ? $content : $this->title,
                ], $key);
    }

    public function registerMetaKeywords($content, $key = null) {
        $this->registerMetaTag([
            'name' => 'keywords',
            'content' => $content,
                ], $key);
    }

    public function registerMetaDescription($content, $key = null) {
        $this->registerMetaTag([
            'name' => 'description',
            'content' => $content,
                ], $key);
    }

    /**
     * register meta tag for social media
     * ------------
     * $content = [
     * 		'title' => <title>,
     * 		'type' => ..., //optional
     * 		'url' => <url>,
     * 		'image' => <imageUrl>,
     * 		'description' => <description of the article>,
     * ];
     * ------------
     * 
     * @param type $content array
     */
    public function registerMetaSocialMedia($content) {
        $defaultTitle = $this->title;
        $defaultType = 'article';
        $defaultUrl = Yii::$app->getUrlManager()->createAbsoluteUrl(Yii::$app->request->url);
        $defaultImage = Config::getAppSeoImageUrl();
        $defaultDescription = Config::getAppMetaDescription();

        /** Twitter card data * */
        $this->registerMetaTag([
            'name' => 'twitter:card',
            'value' => 'summary',
        ]);

        /** Open Graph * */
        $this->registerMetaTag([
            'property' => 'og:title',
            'content' => array_key_exists('title', $content) ? $content['title'] : $defaultTitle,
        ]);
        $this->registerMetaTag([
            'property' => 'og:type',
            'content' => array_key_exists('type', $content) ? $content['type'] : $defaultType,
        ]);
        $this->registerMetaTag([
            'property' => 'og:url',
            'content' => array_key_exists('url', $content) ? $content['url'] : $defaultUrl,
        ]);
        $this->registerMetaTag([
            'property' => 'og:image',
            'content' => array_key_exists('image', $content) ? $content['image'] : $defaultImage,
        ]);
        $this->registerMetaTag([
            'property' => 'og:description',
            'content' => array_key_exists('description', $content) ? $content['description'] : $defaultDescription,
        ]);
        
        $this->registerMetaTag([
            'property' => 'twitter:card',
            'content' => 'summary',
        ]);
        $this->registerMetaTag([
            'property' => 'twitter:url',
            'content' => array_key_exists('url', $content) ? $content['url'] : $defaultUrl,
        ]);
        $this->registerMetaTag([
            'property' => 'twitter:image',
            'content' => array_key_exists('image', $content) ? $content['image'] : $defaultImage,
        ]);
        $this->registerMetaTag([
            'property' => 'twitter:description',
            'content' => array_key_exists('description', $content) ? $content['description'] : $defaultDescription,
        ]);
        
        $this->registerMetaTag([
            'itemscope' => true,
            'itemtype' => 'http://schema.org/Article',
        ]);
        
        $this->registerMetaTag([
            'itemprop' => 'headline',
            'content' => array_key_exists('title', $content) ? $content['title'] : $defaultTitle,
        ]);
        
        $this->registerMetaTag([
            'itemprop' => 'name',
            'content' => array_key_exists('title', $content) ? $content['title'] : $defaultTitle,
        ]);
        
        $this->registerMetaTag([
            'itemprop' => 'description',
            'content' => array_key_exists('description', $content) ? $content['description'] : $defaultDescription,
        ]);
        
        $this->registerMetaTag([
            'itemprop' => 'image',
            'content' => array_key_exists('image', $content) ? $content['image'] : $defaultImage,
        ]);
    }
}
