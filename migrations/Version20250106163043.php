<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250106163043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE recipe_tag (
            recipe_id INT NOT NULL, 
            tag_id INT NOT NULL, 
            INDEX IDX_72DED3CF59D8A214 (recipe_id), 
            INDEX IDX_72DED3CFBAD26311 (tag_id), 
            PRIMARY KEY(recipe_id, tag_id)
        ) DEFAULT CHARACTER 
        SET 
            utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE 
            recipe_tag 
        ADD 
            CONSTRAINT FK_72DED3CF59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE 
            recipe_tag 
        ADD 
            CONSTRAINT FK_72DED3CFBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE recipe_tag DROP FOREIGN KEY FK_72DED3CF59D8A214');
        $this->addSql('ALTER TABLE recipe_tag DROP FOREIGN KEY FK_72DED3CFBAD26311');
        $this->addSql('DROP TABLE recipe_tag');
    }
}
