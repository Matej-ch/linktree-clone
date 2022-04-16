<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220415144352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE color RENAME INDEX idx_c2bec39f9d86650f TO IDX_665648E9A76ED395');
        $this->addSql('ALTER TABLE color_visit RENAME INDEX idx_61562718e88cce5 TO IDX_32B2BB8B7ADA1FB5');
        $this->addSql('ALTER TABLE link ADD text_color VARCHAR(512) DEFAULT NULL');
        $this->addSql('ALTER TABLE link RENAME INDEX idx_d182a1189d86650f TO IDX_36AC99F1A76ED395');
        $this->addSql('ALTER TABLE link_visit RENAME INDEX idx_258c7d65d0ffc289 TO IDX_ECC5B5E7ADA40271');
        $this->addSql('ALTER TABLE user ADD text_size VARCHAR(255) DEFAULT NULL, ADD border_size VARCHAR(255) DEFAULT NULL, ADD border_radius VARCHAR(255) DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE color RENAME INDEX idx_665648e9a76ed395 TO IDX_C2BEC39F9D86650F');
        $this->addSql('ALTER TABLE color_visit RENAME INDEX idx_32b2bb8b7ada1fb5 TO IDX_61562718E88CCE5');
        $this->addSql('ALTER TABLE link DROP text_color');
        $this->addSql('ALTER TABLE link RENAME INDEX idx_36ac99f1a76ed395 TO IDX_D182A1189D86650F');
        $this->addSql('ALTER TABLE link_visit RENAME INDEX idx_ecc5b5e7ada40271 TO IDX_258C7D65D0FFC289');
        $this->addSql('ALTER TABLE user DROP text_size, DROP border_size, DROP border_radius, CHANGE name name VARCHAR(255) NOT NULL');
    }
}
