<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220319190508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE color_visit (id INT AUTO_INCREMENT NOT NULL, color_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, user_agent VARCHAR(2048) DEFAULT NULL, INDEX IDX_61562718E88CCE5 (color_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, value VARCHAR(2048) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, text VARCHAR(1024) DEFAULT NULL, INDEX IDX_C2BEC39F9D86650F (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link_visit (id INT AUTO_INCREMENT NOT NULL, link_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, user_agent VARCHAR(2048) DEFAULT NULL, INDEX IDX_258C7D65D0FFC289 (link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, link VARCHAR(1024) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_D182A1189D86650F (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE color_visit ADD CONSTRAINT FK_61562718E88CCE5 FOREIGN KEY (color_id) REFERENCES color (id)');
        $this->addSql('ALTER TABLE color ADD CONSTRAINT FK_C2BEC39F9D86650F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE link_visit ADD CONSTRAINT FK_258C7D65D0FFC289 FOREIGN KEY (link_id) REFERENCES link (id)');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_D182A1189D86650F FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE color_visit DROP FOREIGN KEY FK_61562718E88CCE5');
        $this->addSql('ALTER TABLE link_visit DROP FOREIGN KEY FK_258C7D65D0FFC289');
        $this->addSql('DROP TABLE color_visit');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE link_visit');
        $this->addSql('DROP TABLE link');
    }
}
