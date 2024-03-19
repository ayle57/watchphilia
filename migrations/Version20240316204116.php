<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240316204116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE watch ADD image_url VARCHAR(255) DEFAULT NULL, CHANGE section_id section_id INT NOT NULL');
        $this->addSql('ALTER TABLE watch_property DROP FOREIGN KEY FK_E20D20BFC7C58135');
        $this->addSql('ALTER TABLE watch_property ADD CONSTRAINT FK_E20D20BFC7C58135 FOREIGN KEY (watch_id) REFERENCES watch (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE watch_property DROP FOREIGN KEY FK_E20D20BFC7C58135');
        $this->addSql('ALTER TABLE watch_property ADD CONSTRAINT FK_E20D20BFC7C58135 FOREIGN KEY (watch_id) REFERENCES watch (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE watch DROP image_url, CHANGE section_id section_id INT DEFAULT NULL');
    }
}
