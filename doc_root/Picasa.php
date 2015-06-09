<?php
/**
 * Description of Picasa
 *
 * @author runt
 */
class Picasa {

private $user;
private $url;
private $albumsArray;
private $projection;
private $path;
private $kind;
private $projectionArray = array('base'=>'/base','api'=>'/api');
private $kindsArray = array('album'=>'album','photo'=>'photo','comment'=>'comment','tag'=>'tag','user'=>'user');

static public $PICASAWEBURL = 'http://picasaweb.google.com';
static public $GURI = 'http://picasaweb.google.com/data/feed';
static public $NS_GPHOTO = 'http://schemas.google.com/photos/2007';
static public $NS_MEDIA = 'http://search.yahoo.com/mrss/';
/**
 * Objekt pro praci s Picasa alby
 * @param string $user uzivatel alba
 * @param boolean $initAlbumsArray , true - inicializuje pole se seznamem verejnych alb, false nic neinicializuje, default je true
 */
function __construct($user=null,$initAlbumsArray=true) {

    $this->projection = $this->projectionArray['api'];
    $this->user = trim($user);
    $this->path = '/user/'.$this->user;
    $this->kind = $this->kindsArray['album'];

    $this->url = self::$GURI.$this->projection.$this->path;

    if($initAlbumsArray)
        $this->initPicasaAlbumsArray();
}

public function setProjection($projection='api'){
    if(array_key_exists($projection, $this->projectionArray)){
        $this->projection = $this->projectionArray[$projection];
    }
    else{
        // pokud zada nejaky nesmysl, nastavim projection na api
        $this->projection = $this->projectionArray['api'];
    }
}


public function getUser() {
    return $this->user;
}

public function setUser($user) {
    $this->user = $user;
}

public function getPath() {
    return $this->path;
}

public function getUrl(){
    return self::$GURI.$this->projection.$this->path;
}
/**
 * returns associative array with indexes :
 * id = album id
 * numphotos = number of photos in album
 * title = album title
 * description = album description
 * thumbnail = album thumbnail url
 * @param $skip - number of albumt to skip from begin
 * 
 * @return array
 */
public function getPicasaAlbumsArray($skip=0){
    if($skip>=count($this->albumsArray)) $skip = count($this->albumsArray)-1;
    $returnedArray = array_slice($this->albumsArray, $skip);
    if($skip>=0)
        return $returnedArray;
    else
        return null;
}


/**
 *
 * @param int $maxResults
 * @return string
 */
public function getAlbumsFeed($maxResults=0){
    $ch = curl_init();
    $this->path = '/user/'.$this->user;
    if($maxResults>0)
        $url = sprintf("%s?max-results=%d",$this->getUrl(),$maxResults);
    else
        $url = sprintf("%s?",$this->getUrl());

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

/**
 *
 * @param string $feed 
 */
public function getAlbumsArrayFromFeed($feed){
    $albumsArray = array();
    $xmlDoc = simplexml_load_string($feed);
    if($xmlDoc!==FALSE){
        $alba = $xmlDoc->entry;
        foreach ($alba as $cislo=>$album){
            $ns_gphoto = $album->children(self::$NS_GPHOTO);
            $ns_media = $album->children(self::$NS_MEDIA);
            $attributes = $ns_media->group->thumbnail->attributes();
            $thumbnail_url = $attributes['url'];
            $timestamp = intval(substr(trim($ns_gphoto->timestamp), 0, strlen(trim($ns_gphoto->timestamp))-3));

            array_push($albumsArray, array(
                                            'id'=>trim($ns_gphoto->id),
                                            'numphotos'=>intval(trim($ns_gphoto->numphotos)),
                                            'timestamp'=>$timestamp,
                                            'datum'=>date('Y-m-d',$timestamp),
                                            'title'=>trim($ns_media->group->title),
                                            'description'=>trim($ns_media->group->description),
                                            'albumlink'=>self::$PICASAWEBURL.'/'.$this->user.'/'.$ns_gphoto->name,
                                            'thumbnail'=>trim($thumbnail_url),
                                            'published'=>trim($album->published),
            ));
        }
    }
    return $albumsArray;
}


public function getPhotosFeedFromAlbumId($albumID,$maxResults=0,$thumbSize='220'){
    $ch = curl_init();
    // thumbsize croped and uncroped 32, 48, 64, 72, 104, 144, 150, 160
    // thumbsize only uncroped sizes 94, 110, 128, 200, 220, 288, 320, 400, 512, 576, 640, 720, 800, 912, 1024, 1152, 1280, 1440, 1600


    // /user/userID/albumid/albumID?kind=kinds

    $this->path = '/user/'.$this->user.'/albumid/'.$albumID;
    if($maxResults>0)
        $url = sprintf("%s?max-results=%d&thumbsize=%s",$this->getUrl(),$maxResults,$thumbSize);
    else
        $url = sprintf("%s?thumbsize=%d",$this->getUrl(),$thumbSize);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

/**
 *
 * @param <type> $feed
 * @return <type>
 */
public function getPhotosArrayFromFeed($feed){
    $albumsArray = array();
    $xmlDoc = simplexml_load_string($feed);
    if($xmlDoc!==FALSE){
        $alba = $xmlDoc->entry;
        foreach ($alba as $cislo=>$album){
            $ns_gphoto = $album->children(self::$NS_GPHOTO);
            $ns_media = $album->children(self::$NS_MEDIA);
            $attributes = $ns_media->group->thumbnail->attributes();
            $thumbnail_url = $attributes['url'];
            $media_content_attributes = $ns_media->group->content->attributes();

            $timestamp = intval(substr(trim($ns_gphoto->timestamp), 0, strlen(trim($ns_gphoto->timestamp))-3));

            array_push($albumsArray, array(
                                            'id'=>trim($ns_gphoto->id),
                                            'position'=>intval(trim($ns_gphoto->position)),
                                            'width'=>intval(trim($ns_gphoto->width)),
                                            'height'=>intval(trim($ns_gphoto->height)),
                                            'size'=>intval(trim($ns_gphoto->size)),
                                            'timestamp'=>$timestamp,
                                            'datum'=>date('Y-m-d',$timestamp),
                                            'title'=>trim($ns_media->group->title),
                                            'description'=>trim($ns_media->group->description),
                                            'photolink'=>trim($media_content_attributes['url']),
                                            'thumbnail'=>trim($thumbnail_url),
                                            'published'=>trim($album->published),
            ));
        }
    }
    return $albumsArray;
}

public function getRandomPhoto($thumbSize){
    $albumsArray = $this->getAlbumsArrayFromFeed($this->getAlbumsFeed());
    $pocetAlb = count($albumsArray);
}
/**
 *
 * @param int $maxResults maximalni pocet alb o kterych chci informaci defaut = 0 = vsechna dostupna alba
 */
public function initPicasaAlbumsArray($maxResults=0) {
    $ch = curl_init();
    if($maxResults>0)
        $url = sprintf("%s?max-results=%d",$this->getUrl(),$maxResults);
    else
        $url = sprintf("%s?",$this->getUrl());

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $this->albumsArray = array();

    $feed = simplexml_load_string($output);
    if($feed!==FALSE) {
        $alba = $feed->entry;
        foreach($alba as $cislo=>$album) {
            //vytazeni namespaces podle http://www.sitepoint.com/blogs/2005/10/20/simplexml-and-namespaces/
            $ns_gphoto = $album->children(self::$NS_GPHOTO);
            $ns_media = $album->children(self::$NS_MEDIA);
            $attributes = $ns_media->group->thumbnail->attributes();
            $thumbnail_url = $attributes['url'];

            array_push($this->albumsArray, array(
                    'id'=>$ns_gphoto->id,
                    'numphotos'=>$ns_gphoto->numphotos,
                    'timestamp'=>$ns_gphoto->timestamp/1000,
                    'datum'=>date('Y-m-d',$ns_gphoto->timestamp/1000),
                    'title'=>$ns_media->group->title,
                    'description'=>$ns_media->group->description,
                    'albumlink'=>self::$PICASAWEBURL.'/'.$this->user.'/'.$ns_gphoto->name,
                    'thumbnail'=>$thumbnail_url,
                    'published'=>$album->published,
                    )
            );
        }
    }
}

}
?>
