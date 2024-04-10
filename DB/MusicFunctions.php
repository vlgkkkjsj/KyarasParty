<?php
class MusicDB
{
    private $connection;
    private $id;
    private $musicName;
    private $author;
    private $linkMusic;
    private $findMusic;


    public function __construct()
    {
        $this->connection = new Connection();
    }
       // Getter para $id
       public function getID()
    {
        return $this->id;
    }
    public function getMusicName()
    {
        return $this-> musicName;
    }
    public function getAuthor()
    {
        return $this->author;
    }
    public function getLinkMusic()
    {
        return $this->linkMusic;
    }
    public function getFindMusic()
    {
        return $this->findMusic;
    }

    // function setters variables

    public function setID($id)
    {
        $this->id = $id;
    }
    public function setMusicName($musicName)
    {
        $this->musicName = $musicName;
    }
    public function setAuthor($author)
    {
        $this->author = $author;
    }
    public function setLinkMusic($linkMusic)
    {
        $this->linkMusic = $linkMusic;
    }
    public function setFindMusic($findMusic)
    {
        $this->findMusic = $findMusic;
    }

    public function singleSong($musicName)
    {
        $singleSong = "SELECT *FROM musictable WHERE musicName = ?";

        $stmt = mysqli_prepare($this->connection->getConn(),$singleSong);
        mysqli_stmt_bind_param($stmt,"s",$musicName);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($res);
    }
    public function InsertSong($musicName,$author,$linkMusic,$findMusic)
    {
        $musicName = filter_var($musicName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $author = filter_var($author, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $linkMusic = filter_var($linkMusic, FILTER_SANITIZE_URL);
        $findMusic = filter_var($findMusic, FILTER_SANITIZE_FULL_SPECIAL_CHARS);


        if(empty($musicName)||empty($author)||empty($linkMusic)||empty($findMusic))
        {
            print "<script>'Veja se respondeu tudo'</script>";
            print "<script>location.href='Sugestões.php'</script>";
        }
        else 
        {
            $sql = "INSERT INTO musictable (musicName,author,linkMusic,findMusic) VALUES  ('{$musicName}','{$author}','{$linkMusic}','{$findMusic}')";
            $res = mysqli_query($this->connection -> getConn(), $sql);

            if(mysqli_affected_rows($this->connection->getConn())>0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

     }
        public function LoginAdmin($userAdm,$password)
        {
            $sql = "SELECT *FROM adminTable WHERE userAdm = ? AND $password = ?";
            $stmt = mysqli_prepare($this->connection->getConn(), $sql);
            mysqli_stmt_bind_param($stmt,"ss", $userAdm, $password);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($res)>0)
            {
                return true;
            }
            else
            { 
                return false;
            }
        }
        
        public function ListSongs()
        {
            $songs = array();

            $sql = "SELECT *FROM musictable";
            $res = mysqli_query($this->connection->getConn(), $sql);

            while($row = mysqli_fetch_assoc($res))
            {
                $musicDB = new MusicDB();

                $musicDB -> setID($row['id']);
                $musicDB -> setMusicName($row['musicName']);
                $musicDB -> setAuthor($row['author']);
                $musicDB -> setLinkMusic($row['linkMusic']);
                $musicDB -> setFindMusic($row['findMusic']);

                $songs[] = $musicDB;
            }
            return $songs;
        }

}
