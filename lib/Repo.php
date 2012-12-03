<?php
/**
 * User: elron
 * Date: 15/09/12
 * Time: 16:42
 */
class Repo
{
    private $sz_Name;

    /**
     * @var string
     */
    private $sz_Rights;

    /**
     * @var array
     */
    private $a_Users;

    /**
     * Init properties
     *
     * @param $the_RepoData
     */
    function __construct($the_RepoData = null)
    {
        if (!empty($the_RepoData))
            $this->setPropreties($the_RepoData);
        else {
            $this->sz_Rights = "";
            $this->a_Users = null;
        }
    }

    /**
     * Set Data
     *
     * @param $the_a_RepoData
     * @return bool
     */
    public function setPropreties($the_a_RepoData)
    {
        $a_Content = explode("\n", $the_a_RepoData);
        $this->sz_Name = trim($a_Content[0]);
        $a_Temp = explode("=", trim($a_Content[1]));
        $a_UsersTmp = explode(" ", trim($a_Temp[1]));
        $this->a_Users = array();
        foreach ($a_UsersTmp as $sz_User) {
            if (trim($sz_User) !== "")
                $this->a_Users[] = $sz_User;
        }

        $this->sz_Rights = $a_Temp[0];
        if (empty($this->a_Users) || empty($this->sz_Rights))
            return false;
        return true;
    }

    /**
     * @return string
     */
    public function getFileData()
    {
        return "repo $this->sz_Name \n\t$this->sz_Rights     =   " . implode(" ", $this->a_Users) . "\n";
    }

    /**
     * handle echo on the object
     *
     * @return string
     */
    function __toString()
    {
        return "Repo: $this->sz_Name <br>Users : " . implode(", ", $this->a_Users) . "<br>" .
            "Rights : $this->sz_Rights <br>";
    }

    /**
     * @param $sz_Name
     */
    public function setName($sz_Name)
    {
        $this->sz_Name = $sz_Name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->sz_Name;
    }

    /**
     * @param string $sz_Rights
     */
    public function setRights($sz_Rights)
    {
        $this->sz_Rights = $sz_Rights;
    }

    /**
     * @return string
     */
    public function getRights()
    {
        return $this->sz_Rights;
    }


    /**
     * @param array $a_Users
     */
    public function setUsers($a_Users)
    {
        $this->a_Users = $a_Users;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->a_Users;
    }


    /* todo : get users info */
}
