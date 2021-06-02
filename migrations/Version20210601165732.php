<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210601165732 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE log_token (id INT AUTO_INCREMENT NOT NULL, token_id INT NOT NULL, user_id INT DEFAULT NULL, user_agent VARCHAR(255) NOT NULL, INDEX IDX_7F494A6641DEE7B9 (token_id), INDEX IDX_7F494A66A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE token (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE log_token ADD CONSTRAINT FK_7F494A6641DEE7B9 FOREIGN KEY (token_id) REFERENCES token (id)');
        $this->addSql('ALTER TABLE log_token ADD CONSTRAINT FK_7F494A66A76ED395 FOREIGN KEY (user_id) REFERENCES users (idUsers)');
        $this->addSql('ALTER TABLE users CHANGE zipCode zipCode VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE log_token DROP FOREIGN KEY FK_7F494A6641DEE7B9');
        $this->addSql('DROP TABLE log_token');
        $this->addSql('DROP TABLE token');
        $this->addSql('ALTER TABLE users CHANGE zipCode zipCode CHAR(5) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
