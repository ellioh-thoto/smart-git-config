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
        $this->sz_FilePath = './data/gitolite.conf';
        $this->setRepositoriesFromFile();
    }

    /**
     * @param string $filePath
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
                $this->a_Repos[] = new Repo($rd);

            }
            return true;
        } else {
            return false;
        }

    }

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
