<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MoviesRepository")
 */
class Movies
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $movie_id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\MovieList", inversedBy="movies")
     */
    private $movie_list;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\user", inversedBy="movies")
     */
    private $user;

    public function __construct()
    {
        $this->movie_list = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovieId(): ?string
    {
        return $this->movie_id;
    }

    public function setMovieId(string $movie_id): self
    {
        $this->movie_id = $movie_id;

        return $this;
    }

    /**
     * @return Collection|MovieList[]
     */
    public function getMovieList(): Collection
    {
        return $this->movie_list;
    }

    public function addMovieList(MovieList $movieList): self
    {
        if (!$this->movie_list->contains($movieList)) {
            $this->movie_list[] = $movieList;
        }

        return $this;
    }

    public function removeMovieList(MovieList $movieList): self
    {
        if ($this->movie_list->contains($movieList)) {
            $this->movie_list->removeElement($movieList);
        }

        return $this;
    }

    /**
     * @return Collection|user[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(user $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(user $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
        }

        return $this;
    }
}
