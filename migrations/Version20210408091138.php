<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210408091138 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe ADD idCategory INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B13755EF339A FOREIGN KEY (idCategory) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_DA88B13755EF339A ON recipe (idCategory)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B13755EF339A');
        $this->addSql('DROP INDEX IDX_DA88B13755EF339A ON recipe');
        $this->addSql('ALTER TABLE recipe DROP idCategory');
    }
}
