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
     * @var array
     */
    private $a_Users;

    /**
     * @var string
     */
    private $sz_Rights;

    /**
     * Init properties
     *
     * @param $the_RepoData
     */
    function __construct($the_RepoData)
    {
        if (!empty($the_RepoData))
            $this->setUsersAndRights($the_RepoData);
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
    public function setUsersAndRights($the_a_RepoData)
    {
        $a_Content = explode("\n", $the_a_RepoData);
        $this->sz_Name = trim($a_Content[0]);
        $a_Temp = explode("=", trim($a_Content[1]));
        $this->a_Users = explode(" ", trim($a_Temp[1]));
        $this->sz_Rights = $a_Temp[0];
        if (empty($this->a_Users) || empty($this->sz_Rights))
            return false;
        return true;
    }

    /**
     * handle echo on the object
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


    /* todo : get users info */
}
