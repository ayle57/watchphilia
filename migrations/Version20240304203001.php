<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240304203001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'CREATE Tables related to many entities';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE property (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE section (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, min_price INTEGER DEFAULT NULL, exact_price INTEGER DEFAULT NULL, max_price INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE sub_section (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, username VARCHAR(100) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
        $this->addSql('CREATE TABLE watch (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, subsection_id INTEGER NOT NULL, section_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, price DOUBLE PRECISION NOT NULL, thumbnail_link CLOB NOT NULL, CONSTRAINT FK_500B4A2687B204D9 FOREIGN KEY (subsection_id) REFERENCES sub_section (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_500B4A26D823E37A FOREIGN KEY (section_id) REFERENCES section (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_500B4A2687B204D9 ON watch (subsection_id)');
        $this->addSql('CREATE INDEX IDX_500B4A26D823E37A ON watch (section_id)');
        $this->addSql('CREATE TABLE watch_property (watch_id INTEGER NOT NULL, property_id INTEGER NOT NULL, PRIMARY KEY(watch_id, property_id), CONSTRAINT FK_E20D20BFC7C58135 FOREIGN KEY (watch_id) REFERENCES watch (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E20D20BF549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E20D20BFC7C58135 ON watch_property (watch_id)');
        $this->addSql('CREATE INDEX IDX_E20D20BF549213EC ON watch_property (property_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE sub_section');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE watch');
        $this->addSql('DROP TABLE watch_property');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
