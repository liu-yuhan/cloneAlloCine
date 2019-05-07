<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190412164035 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE movies (id INT AUTO_INCREMENT NOT NULL, movie_id VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movies_movie_list (movies_id INT NOT NULL, movie_list_id INT NOT NULL, INDEX IDX_E65833E353F590A4 (movies_id), INDEX IDX_E65833E31D3854A5 (movie_list_id), PRIMARY KEY(movies_id, movie_list_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movies_user (movies_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_DE9A798353F590A4 (movies_id), INDEX IDX_DE9A7983A76ED395 (user_id), PRIMARY KEY(movies_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_list (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, list_name VARCHAR(255) NOT NULL, INDEX IDX_B7AED915A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movies_movie_list ADD CONSTRAINT FK_E65833E353F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movies_movie_list ADD CONSTRAINT FK_E65833E31D3854A5 FOREIGN KEY (movie_list_id) REFERENCES movie_list (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movies_user ADD CONSTRAINT FK_DE9A798353F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movies_user ADD CONSTRAINT FK_DE9A7983A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_list ADD CONSTRAINT FK_B7AED915A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE movies_movie_list DROP FOREIGN KEY FK_E65833E353F590A4');
        $this->addSql('ALTER TABLE movies_user DROP FOREIGN KEY FK_DE9A798353F590A4');
        $this->addSql('ALTER TABLE movies_movie_list DROP FOREIGN KEY FK_E65833E31D3854A5');
        $this->addSql('DROP TABLE movies');
        $this->addSql('DROP TABLE movies_movie_list');
        $this->addSql('DROP TABLE movies_user');
        $this->addSql('DROP TABLE movie_list');
    }
}
