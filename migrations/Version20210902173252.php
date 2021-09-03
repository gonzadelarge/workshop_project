<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210902173252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mecanico ADD cod_cita_id INT DEFAULT NULL, ADD cod_vehiculo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mecanico ADD CONSTRAINT FK_D2521E7A8CB9ED4B FOREIGN KEY (cod_cita_id) REFERENCES cita (id)');
        $this->addSql('ALTER TABLE mecanico ADD CONSTRAINT FK_D2521E7A900C068E FOREIGN KEY (cod_vehiculo_id) REFERENCES vehiculo (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D2521E7A8CB9ED4B ON mecanico (cod_cita_id)');
        $this->addSql('CREATE INDEX IDX_D2521E7A900C068E ON mecanico (cod_vehiculo_id)');
        $this->addSql('ALTER TABLE user ADD cod_cita_id INT DEFAULT NULL, DROP vehiculo');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498CB9ED4B FOREIGN KEY (cod_cita_id) REFERENCES cita (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6498CB9ED4B ON user (cod_cita_id)');
        $this->addSql('ALTER TABLE vehiculo ADD cod_user_id INT DEFAULT NULL, ADD cod_cita_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehiculo ADD CONSTRAINT FK_C9FA160335D62301 FOREIGN KEY (cod_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vehiculo ADD CONSTRAINT FK_C9FA16038CB9ED4B FOREIGN KEY (cod_cita_id) REFERENCES cita (id)');
        $this->addSql('CREATE INDEX IDX_C9FA160335D62301 ON vehiculo (cod_user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C9FA16038CB9ED4B ON vehiculo (cod_cita_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mecanico DROP FOREIGN KEY FK_D2521E7A8CB9ED4B');
        $this->addSql('ALTER TABLE mecanico DROP FOREIGN KEY FK_D2521E7A900C068E');
        $this->addSql('DROP INDEX UNIQ_D2521E7A8CB9ED4B ON mecanico');
        $this->addSql('DROP INDEX IDX_D2521E7A900C068E ON mecanico');
        $this->addSql('ALTER TABLE mecanico DROP cod_cita_id, DROP cod_vehiculo_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498CB9ED4B');
        $this->addSql('DROP INDEX UNIQ_8D93D6498CB9ED4B ON user');
        $this->addSql('ALTER TABLE user ADD vehiculo VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP cod_cita_id');
        $this->addSql('ALTER TABLE vehiculo DROP FOREIGN KEY FK_C9FA160335D62301');
        $this->addSql('ALTER TABLE vehiculo DROP FOREIGN KEY FK_C9FA16038CB9ED4B');
        $this->addSql('DROP INDEX IDX_C9FA160335D62301 ON vehiculo');
        $this->addSql('DROP INDEX UNIQ_C9FA16038CB9ED4B ON vehiculo');
        $this->addSql('ALTER TABLE vehiculo DROP cod_user_id, DROP cod_cita_id');
    }
}
