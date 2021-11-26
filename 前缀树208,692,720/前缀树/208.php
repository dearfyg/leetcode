<?php
/**
 * 前缀树 leetcode 208
 * Is a tree data structure for efficiently storing and retrieving keys in a string data set.  
 * This data structure has a number of applications, such as auto-completion and spell checking.  
 */
class Tric {
    private $root;
    public function __construct()
    {
        //初始化root节点
        $this->root = new InstanTric();
    }

    /**
     * 插入树
     */
    public function Insert($word) {
        $root = $this->root; //root节点
        for($i = 0; $i < strlen($word); ++$i) { //循环要插入的词汇
            $index = ord($word[$i]) - ord('a');
            if ($root->children[$index] == null) { //判断树中是否有此节点
                $root->children[$index] = new InstanTric(); //没有此节点则分叉
            }
            $root = $root->children[$index]; //当前的单词作为分叉的parent
        }
        $root->isEnd = true;//一个词汇最终添加完成
    }

    /**
     * 搜索树
     */
    public function CommonSearch($word) {
        $root = $this->root; //root节点
        for($i = 0; $i < strlen($word); ++$i) { //循环查找的词汇
            $index = ord($word[$i]) - ord('a');
            if ($root->children[$index] == null) { //下个节点没有代表没有这个词汇，  直接返回false
                return false;
            }
            $root = $root->children[$index]; //找到了，把节点推向下一个节点
        }
        return $root; //返回查找的树
    }

    /**
     * 搜索单词
     * tip；其实只需要判断是否达到词尾
     */
    public function Search($word) {
       $node = $this->CommonSearch($word);
       return $node != null && $node->isEnd == true;
    }

    /**
     * 搜索单词前缀
     */
    public function SearchPrefix($prefix) {
        return $this->CommonSearch($prefix) != null;
    }
}
/**
 * 每个节点的存储规则
 */
class InstanTric {
    public $children;
    public $isEnd;
    public $val;
    public function __construct()
    {
        //主要查单词 所以数组大小26就够
        $this->children = array_fill(0, 26, null);
        //是否达到一个词的末尾
        $this->isEnd = false;
    }
}
$tric = new Tric();
$tric->Insert("qwe");
var_dump($tric->Search("qwe"));
var_dump($tric->SearchPrefix("qw"));
var_dump($tric->Search("q"));
var_dump($tric->Insert("apple"));
var_dump($tric->Insert("apple"));
var_dump($tric->Insert("world"));
var_dump($tric->CommonSearch("q"));
