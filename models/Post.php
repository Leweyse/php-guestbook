<?php
declare(strict_types=1);

class Post
{
    private string $title = "title";
    private string $date = "date";
    private string $content = "content";
    private string $author = "author";

    private array $data = [];
    private array $fields = [];
    private array $errors = [];

    private bool $validated = false;

    public function __construct() {
        $this -> fields = [$this -> title, $this -> date, $this -> content, $this -> author];

        foreach ($this -> fields as $field) {
            if ($field == "date") array_push($this -> data, date("F j, Y, g:i a"));
            else array_push($this -> data, test_input($_POST["$field"]));
        }
    }

    public function validateFields() : void
    {
        foreach ($this -> fields as $key => $field) {
            if ($this -> data[$key] == "") array_push($this -> errors, ucfirst("$field is required!" . "<br>"));
        }

        if (count($this -> errors) > 0) {
            $this -> validated = false;
            foreach ($this -> errors as $error) errorComponent($error);
        } else {
            $this -> validated = true;
            successComponent("Added message!");
        }
    }

    public function getValidation() : bool
    {
        return $this -> validated;
    }
    
    public function getFields() : array
    {
        return $this -> fields;
    }

    public function getTitle() : string
    {
        return $this -> data[0];
    }

    public function getDate() : string
    {
        return $this -> data[1];
    }

    public function getContent() : string
    {
        return $this -> data[2];
    }

    public function getAuthor() : string
    {
        return $this -> data[3];
    }
}