<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241016154034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE category (
            id INT AUTO_INCREMENT NOT NULL, 
            title VARCHAR(255) NOT NULL, 
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER 
        SET 
            utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_recipe (
            category_id INT NOT NULL, 
            recipe_id INT NOT NULL, 
            INDEX IDX_D5607B4C12469DE2 (category_id), 
            INDEX IDX_D5607B4C59D8A214 (recipe_id), 
            PRIMARY KEY(category_id, recipe_id)
        ) DEFAULT CHARACTER 
        SET 
            utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE 
            category_recipe 
        ADD 
            CONSTRAINT FK_D5607B4C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE 
            category_recipe 
        ADD 
            CONSTRAINT FK_D5607B4C59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE category_recipe DROP FOREIGN KEY FK_D5607B4C12469DE2');
        $this->addSql('ALTER TABLE category_recipe DROP FOREIGN KEY FK_D5607B4C59D8A214');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_recipe');
    }
}
