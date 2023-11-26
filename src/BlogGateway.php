<?php

class BlogGateway
{
    private PDO $conn;
    
    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    
    public function getAll(): array
    {
        $sql = "SELECT *
                FROM blog";
                
        $stmt = $this->conn->query($sql);
        
        $data = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            $row["is_available"] = (bool) $row["is_available"];
            
            $data[] = $row;
        }
        
        return $data;
    }
    
    public function create(array $data): string
    {
        $sql = "INSERT INTO blog (header, contex, author, is_available)
                VALUES (:header, :contex, :author, :is_available)";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":header", $data["header"], PDO::PARAM_STR);
        $stmt->bindValue(":contex", $data["contex"], PDO::PARAM_STR);
        $stmt->bindValue(":author", $data["author"], PDO::PARAM_STR);
        $stmt->bindValue(":is_available", (bool) ($data["is_available"] ?? false), PDO::PARAM_BOOL);
        
        $stmt->execute();
        
        return $this->conn->lastInsertId();
    }
    
    public function get(string $id): array | false
    {
        $sql = "SELECT *
                FROM blog
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($data !== false) {
            $data["is_available"] = (bool) $data["is_available"];
        }
        
        return $data;
    }
    
    public function update(array $current, array $new): int
    {
        $sql = "UPDATE blog
                SET header = :header, contex = :contex, author = :author, is_available = :is_available
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":header", $new["header"] ?? $current["header"], PDO::PARAM_STR);
        $stmt->bindValue(":contex", $new["contex"] ?? $current["contex"], PDO::PARAM_STR);
        $stmt->bindValue(":author", $new["author"] ?? $current["author"], PDO::PARAM_STR);
        $stmt->bindValue(":is_available", $new["is_available"] ?? $current["is_available"], PDO::PARAM_BOOL);
        
        $stmt->bindValue(":id", $current["id"], PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->rowCount();
    }
    
    public function delete(string $id): int
    {
        $sql = "DELETE FROM blog
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->rowCount();
    }
}

?>