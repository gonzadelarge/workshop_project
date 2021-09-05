<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210905144908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cita ADD cod_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A6235D62301 FOREIGN KEY (cod_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3E379A6235D62301 ON cita (cod_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A6235D62301');
        $this->addSql('DROP INDEX UNIQ_3E379A6235D62301 ON cita');
        $this->addSql('ALTER TABLE cita DROP cod_user_id');
    }
}
