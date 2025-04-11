<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250207143520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE recipe SET image = SUBSTRING_INDEX(image, "/", -1)');
        $this->addSql('UPDATE category SET image = SUBSTRING_INDEX(image, "/", -1)');
    }

    public function down(Schema $schema): void {}
}
