<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $profil_pic = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\ManyToMany(targetEntity: Playlist::class, inversedBy: 'users')]
    private Collection $subscribed_playlists;

    #[ORM\OneToMany(mappedBy: 'created_by', targetEntity: Playlist::class)]
    private Collection $playlists;

    #[ORM\OneToMany(mappedBy: 'watched_by', targetEntity: WatchedMovie::class, orphanRemoval: true)]
    private Collection $watchedMovies;

    public function __construct()
    {
        $this->subscribed_playlists = new ArrayCollection();
        $this->playlists = new ArrayCollection();
        $this->watchedMovies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getProfilPic(): ?string
    {
        return $this->profil_pic;
    }

    public function setProfilPic(string $profil_pic): self
    {
        $this->profil_pic = $profil_pic;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getSubscribedPlaylists(): Collection
    {
        return $this->subscribed_playlists;
    }

    public function addSubscribedPlaylist(Playlist $subscribed_playlist): self
    {
        if (!$this->subscribed_playlists->contains($subscribed_playlist)) {
            $this->subscribed_playlists->add($subscribed_playlist);
        }

        return $this;
    }

    public function removeSubscribedPlaylist(Playlist $subscribed_playlist): self
    {
        $this->subscribed_playlists->removeElement($subscribed_playlist);

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getPlaylists(): Collection
    {
        return $this->playlists;
    }

    public function addPlaylist(Playlist $playlist): self
    {
        if (!$this->playlists->contains($playlist)) {
            $this->playlists->add($playlist);
            $playlist->setCreatedBy($this);
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist): self
    {
        if ($this->playlists->removeElement($playlist)) {
            // set the owning side to null (unless already changed)
            if ($playlist->getCreatedBy() === $this) {
                $playlist->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WatchedMovie>
     */
    public function getWatchedMovies(): Collection
    {
        return $this->watchedMovies;
    }

    public function addWatchedMovie(WatchedMovie $watchedMovie): self
    {
        if (!$this->watchedMovies->contains($watchedMovie)) {
            $this->watchedMovies->add($watchedMovie);
            $watchedMovie->setWatchedBy($this);
        }

        return $this;
    }

    public function removeWatchedMovie(WatchedMovie $watchedMovie): self
    {
        if ($this->watchedMovies->removeElement($watchedMovie)) {
            // set the owning side to null (unless already changed)
            if ($watchedMovie->getWatchedBy() === $this) {
                $watchedMovie->setWatchedBy(null);
            }
        }

        return $this;
    }
}
