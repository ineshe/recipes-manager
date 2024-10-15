<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241004142805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE recipe_ingredient (
                id INT AUTO_INCREMENT NOT NULL, 
                recipe_id INT NOT NULL, 
                ingredient_id INT NOT NULL, 
                amount DOUBLE PRECISION DEFAULT NULL, 
                unit VARCHAR(255) DEFAULT NULL, 
                INDEX IDX_22D1FE1359D8A214 (recipe_id), 
                INDEX IDX_22D1FE13933FE08C (ingredient_id), 
                PRIMARY KEY(id)
            ) 
            DEFAULT CHARACTER SET utf8mb4 
            COLLATE `utf8mb4_unicode_ci` 
            ENGINE = InnoDB
        ');

        $this->addSql('
            ALTER TABLE recipe_ingredient 
            ADD CONSTRAINT FK_22D1FE1359D8A214 
            FOREIGN KEY (recipe_id) REFERENCES recipe (id)
        ');

        $this->addSql('
            ALTER TABLE recipe_ingredient 
            ADD CONSTRAINT FK_22D1FE13933FE08C 
            FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('
            ALTER TABLE recipe_ingredient DROP FOREIGN KEY FK_22D1FE1359D8A214
        ');

        $this->addSql('
            ALTER TABLE recipe_ingredient DROP FOREIGN KEY FK_22D1FE13933FE08C
        ');
        
        $this->addSql('DROP TABLE recipe_ingredient');
    }
}
