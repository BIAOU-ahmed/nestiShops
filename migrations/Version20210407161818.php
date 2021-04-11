<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210407161818 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administrator (idAdministrator INT NOT NULL, PRIMARY KEY(idAdministrator)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (idArticle INT AUTO_INCREMENT NOT NULL, unitQuantity SMALLINT NOT NULL, flag VARCHAR(1) NOT NULL, dateCreation DATETIME NOT NULL, dateModification DATETIME DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, idImage INT DEFAULT NULL, idUnit INT NOT NULL, idProduct INT NOT NULL, UNIQUE INDEX UNIQ_23A0E66D2F94742 (idImage), INDEX IDX_23A0E66AF4652CD (idUnit), INDEX IDX_23A0E66C3F36F5F (idProduct), PRIMARY KEY(idArticle)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articleprice (idArticlePrice INT AUTO_INCREMENT NOT NULL, dateStart DATETIME NOT NULL, price DOUBLE PRECISION NOT NULL, idArticle INT DEFAULT NULL, INDEX IDX_27AFD5C312836594 (idArticle), PRIMARY KEY(idArticlePrice)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chef (idChef INT NOT NULL, PRIMARY KEY(idChef)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (idCity INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(idCity)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (commentTitle VARCHAR(255) NOT NULL, commentContent VARCHAR(255) NOT NULL, dateCreation DATETIME NOT NULL, flag VARCHAR(1) NOT NULL, idRecipe INT NOT NULL, idUsers INT NOT NULL, idModerator INT DEFAULT NULL, INDEX IDX_9474526CB99919AD (idRecipe), INDEX IDX_9474526C347E6F4 (idUsers), INDEX IDX_9474526C96DA993E (idModerator), PRIMARY KEY(idRecipe, idUsers)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE connectionlog (idConnectionLog INT AUTO_INCREMENT NOT NULL, dateConnection DATETIME NOT NULL, idUsers INT NOT NULL, INDEX IDX_E4AE92F4347E6F4 (idUsers), PRIMARY KEY(idConnectionLog)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grades (rating DOUBLE PRECISION NOT NULL, idUsers INT NOT NULL, idRecipe INT NOT NULL, INDEX IDX_3AE36110347E6F4 (idUsers), INDEX IDX_3AE36110B99919AD (idRecipe), PRIMARY KEY(idUsers, idRecipe)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (idImage INT AUTO_INCREMENT NOT NULL, dateCreation DATETIME NOT NULL, name VARCHAR(255) NOT NULL, fileExtension VARCHAR(255) NOT NULL, PRIMARY KEY(idImage)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE importation (importationDate DATETIME NOT NULL, idAdministrator INT NOT NULL, idArticle INT DEFAULT NULL, idSupplierOrder INT DEFAULT NULL, INDEX IDX_394DCB28128365946E716640 (idArticle, idSupplierOrder), PRIMARY KEY(idAdministrator, idArticle, idSupplierOrder)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (idIngredient INT NOT NULL, PRIMARY KEY(idIngredient)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredientrecipe (quantity INT NOT NULL, recipePosition INT NOT NULL, idProduct INT NOT NULL, idRecipe INT NOT NULL, idUnit INT NOT NULL, INDEX IDX_49823A6AC3F36F5F (idProduct), INDEX IDX_49823A6AB99919AD (idRecipe), INDEX IDX_49823A6AAF4652CD (idUnit), PRIMARY KEY(idProduct, idRecipe)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lot (idSupplierOrder INT NOT NULL, unitCost DOUBLE PRECISION NOT NULL, dateReception DATETIME NOT NULL, quantity DOUBLE PRECISION NOT NULL, idArticle INT NOT NULL, INDEX IDX_B81291B12836594 (idArticle), PRIMARY KEY(idArticle, idSupplierOrder)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE moderator (idModerator INT NOT NULL, PRIMARY KEY(idModerator)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orderline (quantity INT NOT NULL, idOrders INT NOT NULL, idArticle INT NOT NULL, INDEX IDX_DF24E26C863E5574 (idOrders), INDEX IDX_DF24E26C12836594 (idArticle), PRIMARY KEY(idOrders, idArticle)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (idOrders INT AUTO_INCREMENT NOT NULL, flag VARCHAR(1) NOT NULL, dateCreation DATETIME NOT NULL, idUsers INT NOT NULL, INDEX IDX_E52FFDEE347E6F4 (idUsers), PRIMARY KEY(idOrders)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paragraph (idParagraph INT AUTO_INCREMENT NOT NULL, content VARCHAR(255) NOT NULL, paragraphPosition INT NOT NULL, dateCreation DATETIME NOT NULL, idRecipe INT NOT NULL, INDEX IDX_7DD39862B99919AD (idRecipe), PRIMARY KEY(idParagraph)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (idProduct INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(idProduct)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe (idRecipe INT AUTO_INCREMENT NOT NULL, dateCreation DATETIME NOT NULL, name VARCHAR(255) NOT NULL, difficulty SMALLINT NOT NULL, portions INT NOT NULL, flag VARCHAR(1) NOT NULL, preparationTime INT NOT NULL, idChef INT NOT NULL, idImage INT DEFAULT NULL, INDEX IDX_DA88B13781B51878 (idChef), UNIQUE INDEX UNIQ_DA88B137D2F94742 (idImage), PRIMARY KEY(idRecipe)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit (idUnit INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(idUnit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (idUsers INT AUTO_INCREMENT NOT NULL, lastName VARCHAR(255) NOT NULL, firstName VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, passwordHash VARCHAR(255) NOT NULL, flag VARCHAR(1) NOT NULL, dateCreation DATETIME NOT NULL, login VARCHAR(65) NOT NULL, address1 VARCHAR(255) NOT NULL, address2 VARCHAR(255) DEFAULT NULL, zipCode INT NOT NULL, idCity INT DEFAULT NULL, INDEX IDX_1483A5E95EA65CAA (idCity), PRIMARY KEY(idUsers)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE administrator ADD CONSTRAINT FK_58DF0651923B5A7F FOREIGN KEY (idAdministrator) REFERENCES users (idUsers)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66D2F94742 FOREIGN KEY (idImage) REFERENCES image (idImage)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66AF4652CD FOREIGN KEY (idUnit) REFERENCES unit (idUnit)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66C3F36F5F FOREIGN KEY (idProduct) REFERENCES product (idProduct)');
        $this->addSql('ALTER TABLE articleprice ADD CONSTRAINT FK_27AFD5C312836594 FOREIGN KEY (idArticle) REFERENCES article (idArticle)');
        $this->addSql('ALTER TABLE chef ADD CONSTRAINT FK_F24846E681B51878 FOREIGN KEY (idChef) REFERENCES users (idUsers)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB99919AD FOREIGN KEY (idRecipe) REFERENCES recipe (idRecipe)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C347E6F4 FOREIGN KEY (idUsers) REFERENCES users (idUsers)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C96DA993E FOREIGN KEY (idModerator) REFERENCES moderator (idModerator)');
        $this->addSql('ALTER TABLE connectionlog ADD CONSTRAINT FK_E4AE92F4347E6F4 FOREIGN KEY (idUsers) REFERENCES users (idUsers)');
        $this->addSql('ALTER TABLE grades ADD CONSTRAINT FK_3AE36110347E6F4 FOREIGN KEY (idUsers) REFERENCES users (idUsers)');
        $this->addSql('ALTER TABLE grades ADD CONSTRAINT FK_3AE36110B99919AD FOREIGN KEY (idRecipe) REFERENCES recipe (idRecipe)');
        $this->addSql('ALTER TABLE importation ADD CONSTRAINT FK_394DCB28923B5A7F FOREIGN KEY (idAdministrator) REFERENCES administrator (idAdministrator)');
        $this->addSql('ALTER TABLE importation ADD CONSTRAINT FK_394DCB28128365946E716640 FOREIGN KEY (idArticle, idSupplierOrder) REFERENCES lot (idArticle, idSupplierOrder)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870E95B669A FOREIGN KEY (idIngredient) REFERENCES product (idProduct)');
        $this->addSql('ALTER TABLE ingredientrecipe ADD CONSTRAINT FK_49823A6AC3F36F5F FOREIGN KEY (idProduct) REFERENCES ingredient (idIngredient)');
        $this->addSql('ALTER TABLE ingredientrecipe ADD CONSTRAINT FK_49823A6AB99919AD FOREIGN KEY (idRecipe) REFERENCES recipe (idRecipe)');
        $this->addSql('ALTER TABLE ingredientrecipe ADD CONSTRAINT FK_49823A6AAF4652CD FOREIGN KEY (idUnit) REFERENCES unit (idUnit)');
        $this->addSql('ALTER TABLE lot ADD CONSTRAINT FK_B81291B12836594 FOREIGN KEY (idArticle) REFERENCES article (idArticle)');
        $this->addSql('ALTER TABLE moderator ADD CONSTRAINT FK_6A30B26896DA993E FOREIGN KEY (idModerator) REFERENCES users (idUsers)');
        $this->addSql('ALTER TABLE orderline ADD CONSTRAINT FK_DF24E26C863E5574 FOREIGN KEY (idOrders) REFERENCES orders (idOrders)');
        $this->addSql('ALTER TABLE orderline ADD CONSTRAINT FK_DF24E26C12836594 FOREIGN KEY (idArticle) REFERENCES article (idArticle)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE347E6F4 FOREIGN KEY (idUsers) REFERENCES users (idUsers)');
        $this->addSql('ALTER TABLE paragraph ADD CONSTRAINT FK_7DD39862B99919AD FOREIGN KEY (idRecipe) REFERENCES recipe (idRecipe)');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B13781B51878 FOREIGN KEY (idChef) REFERENCES chef (idChef)');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137D2F94742 FOREIGN KEY (idImage) REFERENCES image (idImage)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E95EA65CAA FOREIGN KEY (idCity) REFERENCES city (idCity)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE importation DROP FOREIGN KEY FK_394DCB28923B5A7F');
        $this->addSql('ALTER TABLE articleprice DROP FOREIGN KEY FK_27AFD5C312836594');
        $this->addSql('ALTER TABLE lot DROP FOREIGN KEY FK_B81291B12836594');
        $this->addSql('ALTER TABLE orderline DROP FOREIGN KEY FK_DF24E26C12836594');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B13781B51878');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E95EA65CAA');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66D2F94742');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137D2F94742');
        $this->addSql('ALTER TABLE ingredientrecipe DROP FOREIGN KEY FK_49823A6AC3F36F5F');
        $this->addSql('ALTER TABLE importation DROP FOREIGN KEY FK_394DCB28128365946E716640');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C96DA993E');
        $this->addSql('ALTER TABLE orderline DROP FOREIGN KEY FK_DF24E26C863E5574');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66C3F36F5F');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870E95B669A');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB99919AD');
        $this->addSql('ALTER TABLE grades DROP FOREIGN KEY FK_3AE36110B99919AD');
        $this->addSql('ALTER TABLE ingredientrecipe DROP FOREIGN KEY FK_49823A6AB99919AD');
        $this->addSql('ALTER TABLE paragraph DROP FOREIGN KEY FK_7DD39862B99919AD');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66AF4652CD');
        $this->addSql('ALTER TABLE ingredientrecipe DROP FOREIGN KEY FK_49823A6AAF4652CD');
        $this->addSql('ALTER TABLE administrator DROP FOREIGN KEY FK_58DF0651923B5A7F');
        $this->addSql('ALTER TABLE chef DROP FOREIGN KEY FK_F24846E681B51878');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C347E6F4');
        $this->addSql('ALTER TABLE connectionlog DROP FOREIGN KEY FK_E4AE92F4347E6F4');
        $this->addSql('ALTER TABLE grades DROP FOREIGN KEY FK_3AE36110347E6F4');
        $this->addSql('ALTER TABLE moderator DROP FOREIGN KEY FK_6A30B26896DA993E');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE347E6F4');
        $this->addSql('DROP TABLE administrator');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE articleprice');
        $this->addSql('DROP TABLE chef');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE connectionlog');
        $this->addSql('DROP TABLE grades');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE importation');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredientrecipe');
        $this->addSql('DROP TABLE lot');
        $this->addSql('DROP TABLE moderator');
        $this->addSql('DROP TABLE orderline');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE paragraph');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE users');
    }
}
