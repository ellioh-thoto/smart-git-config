<?php
/**
 * User: elron
 * Date: 15/09/12
 * Time: 16:41
 */
class Configuration
{
    /**
     * @var string
     */
    private $sz_FilePath;
    /**
     * @var array
     */
    private $a_Repos;


    function __construct()
    {
        $this->sz_FilePath = '../data/confs/gitolite.conf';
        if (file_exists($this->sz_FilePath)) {
            $this->setRepositoriesFromFile();
        }
    }

    /**
     * @param $the_sz_FilePath
     */
    public function setFilePath($the_sz_FilePath)
    {
        $this->sz_FilePath = $the_sz_FilePath;
    }

    /**
     * @return string
     */
    public function getFilePath()
    {
        return $this->sz_FilePath;
    }

    /**
     * Init data from config file
     *
     * @return bool
     */
    public function setRepositoriesFromFile()
    {
        $content = file_get_contents($this->sz_FilePath);
        $a_Reposdata = explode("repo", $content);

        if (!empty($a_Reposdata)) {
            foreach ($a_Reposdata as $rd) {
                if (empty($rd)) continue;
                $tmp = new Repo($rd);
                $this->a_Repos[$tmp->getName()] = $tmp;
            }
            return true;
        } else {
            return false;
        }

    }

    /**
     * if no filename passed in as parameter the preset filename is used
     *
     * @param string $the_sz_FilePath
     * @throws Exception
     */
    public function writeFile($the_sz_FilePath = '')
    {
        $sz_WriteFilePath = $this->sz_FilePath;
        if (!empty($the_sz_FilePath))
            $sz_WriteFilePath = $the_sz_FilePath;

        if (empty($sz_WriteFilePath))
            throw new Exception ('No file specified for writing');

        $sz_Data = "";
        foreach ($this->a_Repos as $o_Repo) {
            /** @var Repo $o_Repo */
            $sz_Data .= $o_Repo->getFileData() . "\n";
        }

        file_put_contents($sz_WriteFilePath, $sz_Data);
    }

    /**
     * @param array $a_Repos
     */
    public function setRepos($a_Repos)
    {
        $this->a_Repos = $a_Repos;
    }

    /**
     * @return array
     */
    public function getRepos()
    {
        return $this->a_Repos;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        $sz_Return = "";
        if (!empty($this->a_Repos)) {
            foreach ($this->a_Repos as $o_Repo) {
                $sz_Return .= $o_Repo . "<br>";
            }
        } else
            $sz_Return = "Configuration empty! :(";
        return $sz_Return;
    }

}
