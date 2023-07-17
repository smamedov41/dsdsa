<?php

class Database extends PDO {


    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {
        try {
            parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';charset=utf8;dbname=' . $DB_NAME, $DB_USER, $DB_PASS);
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(Exception $e){
            die('ERROR: could not connect to mysql');
//            die('ERROR: '. $e->getMessage());
        }
    }

    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
        try {
            $sth = $this->prepare($sql);
            foreach ($array as $key => $value) {
                $sth->bindValue("$key", $value);
            }

            if (!$sth->execute()) {
//                $error = $sth->errorInfo();
//                throw new Exception(json_encode(['mysqlError'=>$error[2]]));
            } else {
                return $sth->fetchAll($fetchMode);
            }
        } catch (Exception $e){
            return ['mysqlError'=>$e->getMessage()];
        }
    }

    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function selectOne($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
        try {
            $sth = $this->prepare($sql);
            foreach ($array as $key => $value) {
                $sth->bindValue("$key", $value);
            }

            if (!$sth->execute()) {
//                 $error = $sth->errorInfo();
//                throw new Exception(json_encode(['mysqlError'=>$error[2]]));
            } else {
                return $sth->fetch($fetchMode);
            }
        } catch (Exception $e){
            return ['mysqlError'=>$e->getMessage()];
        }
    }

    /**
     * select count
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function selectCount($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
        try {
            $sth = $this->prepare($sql);
            foreach ($array as $key => $value) {
                $sth->bindValue("$key", $value);
            }

            if (!$sth->execute()) {
//                $error = $sth->errorInfo();
//                throw new Exception(json_encode(['mysqlError'=>$error[2]]));
            } else {
                $result = $sth->fetchAll($fetchMode);
                if(sizeof($result)){
                    return $result[0]['count'];
                } else {
                    return 0;
                }
            }
        } catch (Exception $e){
            return ['mysqlError'=>$e->getMessage()];
        }
    }

    /**
     * insert
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     */
    public function insert($table, $data) {
        try{
            ksort($data);

            $fieldNames = implode('`, `', array_keys($data));
            $fieldValues = ':' . implode(', :', array_keys($data));

            $query = "INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)";
            $sth = $this->prepare($query);

            foreach ($data as $key => $value) {
                $sth->bindValue(":$key", $value);
            }

            if (!$sth->execute()) {
//                $error = $sth->errorInfo();
//                throw new Exception(json_encode(['mysqlError'=>$error[2]]));
            } else {
                return $this->lastInsertId();
            }
        } catch (Exception $e){
            return ['mysqlError'=>$e->getMessage()];
        }
    }

    /**
     * update
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     * @param string $where the WHERE query part
     */
    public function update($table, $data, $where) {
        try {
            ksort($data);

            $fieldDetails = NULL;
            foreach ($data as $key => $value) {
                $fieldDetails .= "`$key`=:$key,";
            }
            $fieldDetails = rtrim($fieldDetails, ',');
            $query = "UPDATE $table SET $fieldDetails WHERE $where";
            $sth = $this->prepare($query);

            foreach ($data as $key => $value) {
                $sth->bindValue(":$key", $value);
            }

            if (!$sth->execute()) {
//                $error = $sth->errorInfo();
//                throw new PDOException(json_encode(['mysqlError'=>$error[2]]));
            } else {
                return 1;
            }
        } catch (PDOException $e){
            return ['mysqlError'=>$e->getMessage()];
        }
    }

    /**
     * delete
     *
     * @param string $table
     * @param string $where
     * @return integer Affected Rows
     */
    public function delete($table, $where) {
        try {
            $query = "DELETE FROM $table WHERE $where";
            $result = $this->exec($query);

            if ($result === false) {
//                $error = $this->errorInfo();
//                throw new Exception(json_encode(['mysqlError'=>$error[2]]));
            } else {
                return $result;
            }
        } catch (Exception $e){
            return ['mysqlError'=>$e->getMessage()];
        }
    }

}