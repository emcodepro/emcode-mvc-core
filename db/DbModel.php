<?php
/**
 * Created by PhpStorm.
 * User: grand
 * Date: 03-Mar-21
 * Time: 14:19
 */

namespace emcode\phpmvc\db;


use emcode\phpmvc\Application;
use emcode\phpmvc\Model;

abstract class DbModel extends Model
{
    abstract public static function tableName();
    abstract public function attributes();
    abstract public static function primaryKey();


    public static function findOne(array $where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);

        $sql = implode(" AND ", array_map(function($el){
            return "$el = :$el";
        }, $attributes));

        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

        foreach ($where as $key => $value)
        {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();

        return $statement->fetchObject(static::class);

    }

   public function save()
   {
       $tableName = $this->tableName();
       $attributes = $this->attributes();

       $params = array_map(function($el){
           return ":$el";
       }, $attributes);

       $statement = self::prepare("INSERT INTO $tableName (".implode(",", $attributes).") VALUES (".implode(",", $params).")");

       foreach ($attributes as $attribute){
           $statement->bindValue(":$attribute", $this->{$attribute});
       }

       $statement->execute();

       return true;
   }

   public static function prepare($sql)
   {
       return Application::$app->db->pdo->prepare($sql);
   }
}