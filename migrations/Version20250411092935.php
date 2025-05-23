<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250411092935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE step (
          id INT AUTO_INCREMENT NOT NULL,
          recipe_id INT NOT NULL,
          position SMALLINT NOT NULL,
          instruction LONGTEXT NOT NULL,
          INDEX IDX_43B9FE3C59D8A214 (recipe_id),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER
        SET
          utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE step_ingredient (
          id INT AUTO_INCREMENT NOT NULL,
          step_id INT NOT NULL,
          recipe_ingredient_id INT NOT NULL,
          amount DOUBLE PRECISION DEFAULT NULL,
          unit VARCHAR(255) DEFAULT NULL,
          INDEX IDX_67C45E3173B21E9C (step_id),
          INDEX IDX_67C45E313CAF64A (recipe_ingredient_id),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER
        SET
          utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE
          step
        ADD
          CONSTRAINT FK_43B9FE3C59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE
          step_ingredient
        ADD
          CONSTRAINT FK_67C45E3173B21E9C FOREIGN KEY (step_id) REFERENCES step (id)');
        $this->addSql('ALTER TABLE
          step_ingredient
        ADD
          CONSTRAINT FK_67C45E313CAF64A FOREIGN KEY (recipe_ingredient_id) REFERENCES recipe_ingredient (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE step DROP FOREIGN KEY FK_43B9FE3C59D8A214');
        $this->addSql('ALTER TABLE step_ingredient DROP FOREIGN KEY FK_67C45E3173B21E9C');
        $this->addSql('ALTER TABLE step_ingredient DROP FOREIGN KEY FK_67C45E313CAF64A');
        $this->addSql('DROP TABLE step');
        $this->addSql('DROP TABLE step_ingredient');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL COLLATE `utf8mb4_bin`');
    }
}
