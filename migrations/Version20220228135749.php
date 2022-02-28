<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220228135749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_pokemon (type_id INT NOT NULL, pokemon_id INT NOT NULL, INDEX IDX_4AFDFF06C54C8C93 (type_id), INDEX IDX_4AFDFF062FE71C3E (pokemon_id), PRIMARY KEY(type_id, pokemon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type_pokemon ADD CONSTRAINT FK_4AFDFF06C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_pokemon ADD CONSTRAINT FK_4AFDFF062FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE57298EB23357');
        $this->addSql('DROP INDEX IDX_8CDE57298EB23357 ON type');
        $this->addSql('ALTER TABLE type DROP types_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE type_pokemon');
        $this->addSql('ALTER TABLE type ADD types_id INT NOT NULL');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE57298EB23357 FOREIGN KEY (types_id) REFERENCES pokemon (id)');
        $this->addSql('CREATE INDEX IDX_8CDE57298EB23357 ON type (types_id)');
    }
}
