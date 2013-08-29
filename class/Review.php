<?php


/**
 * Description of Review
 *
 * @author Yakud
 */
class Review {
    const SQL_GET = "
        SELECT rev.id, rev.title, rev.description, photo.name as photo
        FROM  review as rev
        JOIN photo on rev.photo = photo.id
        WHERE  rev.id = %d
        LIMIT 1
    "; 
    
    const SQL_GET_ALL_ID = "
        SELECT id 
        FROM review
    ";
    
    /**
     * @var int 
     */
    private $id;
    
    /**
     * @var string
     */
    private $photo;
    
    /**
     * @var string
     */
    private $title;
    
    /**
     * @var string
     */
    private $description;
            
    /**
     * @var string
     */
    private $photo_url = "";
    
    /**
     * @var type 
     */
    private $photo_thumb_url = "";
    
    /**
     * @param int $id
     */
    function __construct($id) {
        $this->setId($id);
        $this->photo_url = "http://".$_SERVER["HTTP_HOST"]."/assets/img/upload/"; 
        $this->photo_thumb_url = "http://".$_SERVER["HTTP_HOST"]."/assets/img/upload/thumb/";
        
        $this->get();
    }
    
    /**
     * @return \Review
     */
    public function get() {
        $query = sprintf(static::SQL_GET, $this->getId());
        $res = mysql_query($query);
        $res = mysql_fetch_assoc($res);
        
        if($res) {
            $this->setId($res['id']);
            $this->setTitle($res['title']);
            $this->setDesciption($res['description']);
            $this->setPhoto($res['photo']);
        }
        return $this;
    }
    
    /**
     * Получаем все id
     * @return array
     */
    static public function getAllId() {
        $all_id = array();
        $query = static::SQL_GET_ALL_ID;
        $res = mysql_query($query);
        while($row = mysql_fetch_array($res)) {
            $all_id[] = $row[0];
        }
        
        return $all_id;
    }


    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }
    
    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }
    
    /**
     * @param string $desciption
     */
    public function setDesciption($desciption) {
        $this->description = $desciption;
    }
    
    /**
     * @param string $photo
     */
    public function setPhoto($photo) {
        $this->photo = $photo;
    }
    
    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }
    
    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }
    
    public function getMinDescription($count = 250) {
        mb_internal_encoding("UTF-8");
        return mb_substr($this->getDescription(), 0, $count);
    }
    
    public function getDiffDescription($count = 250) {
        return str_replace($this->getMinDescription($count), "", $this->getDescription());
    }

    /**
     * @return string
     */
    public function getPhoto() {
        return $this->photo_url.$this->photo;
    }
}
