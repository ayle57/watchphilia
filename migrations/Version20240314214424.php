<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240314214424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, min_price INT DEFAULT NULL, exact_price INT DEFAULT NULL, max_price INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_section (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE watch (id INT AUTO_INCREMENT NOT NULL, subsection_id INT NOT NULL, section_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_500B4A2687B204D9 (subsection_id), INDEX IDX_500B4A26D823E37A (section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE watch_property (watch_id INT NOT NULL, property_id INT NOT NULL, INDEX IDX_E20D20BFC7C58135 (watch_id), INDEX IDX_E20D20BF549213EC (property_id), PRIMARY KEY(watch_id, property_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE watch ADD CONSTRAINT FK_500B4A2687B204D9 FOREIGN KEY (subsection_id) REFERENCES sub_section (id)');
        $this->addSql('ALTER TABLE watch ADD CONSTRAINT FK_500B4A26D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE watch_property ADD CONSTRAINT FK_E20D20BFC7C58135 FOREIGN KEY (watch_id) REFERENCES watch (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE watch_property ADD CONSTRAINT FK_E20D20BF549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE watch DROP FOREIGN KEY FK_500B4A2687B204D9');
        $this->addSql('ALTER TABLE watch DROP FOREIGN KEY FK_500B4A26D823E37A');
        $this->addSql('ALTER TABLE watch_property DROP FOREIGN KEY FK_E20D20BFC7C58135');
        $this->addSql('ALTER TABLE watch_property DROP FOREIGN KEY FK_E20D20BF549213EC');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE sub_section');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE watch');
        $this->addSql('DROP TABLE watch_property');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
