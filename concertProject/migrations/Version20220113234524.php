<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220113234524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE band CHANGE logo logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE concert CHANGE logo logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE hall CHANGE available_tickets available_tickets INT DEFAULT NULL');
        $this->addSql('ALTER TABLE member CHANGE pseudo pseudo VARCHAR(255) DEFAULT NULL, CHANGE picture picture VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE organiser CHANGE phone phone VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE band CHANGE logo logo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE concert CHANGE logo logo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE hall CHANGE available_tickets available_tickets INT DEFAULT NULL');
        $this->addSql('ALTER TABLE member CHANGE pseudo pseudo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE picture picture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE organiser CHANGE phone phone VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
