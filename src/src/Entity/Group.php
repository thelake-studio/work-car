<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupRepository::class)]
#[ORM\Table(name: '`group`')]
class Group
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $creationDate = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $endDate = null;

    #[ORM\ManyToOne(inversedBy: 'managedGroups')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $groupAdmin = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'userGroups')]
    private Collection $participants;

    /**
     * @var Collection<int, GroupLocation>
     */
    #[ORM\OneToMany(targetEntity: GroupLocation::class, mappedBy: 'ownerGroup')]
    private Collection $groupLocations;

    /**
     * @var Collection<int, GroupSchedule>
     */
    #[ORM\OneToMany(targetEntity: GroupSchedule::class, mappedBy: 'ownerGroup')]
    private Collection $groupSchedules;

    /**
     * @var Collection<int, PlannedTrip>
     */
    #[ORM\OneToMany(targetEntity: PlannedTrip::class, mappedBy: 'ownerGroup')]
    private Collection $plannedTrips;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->groupLocations = new ArrayCollection();
        $this->groupSchedules = new ArrayCollection();
        $this->plannedTrips = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeImmutable
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeImmutable $creationDate): static
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeImmutable
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeImmutable $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getGroupAdmin(): ?User
    {
        return $this->groupAdmin;
    }

    public function setGroupAdmin(?User $groupAdmin): static
    {
        $this->groupAdmin = $groupAdmin;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(User $participant): static
    {
        if (!$this->participants->contains($participant)) {
            $this->participants->add($participant);
        }

        return $this;
    }

    public function removeParticipant(User $participant): static
    {
        $this->participants->removeElement($participant);

        return $this;
    }

    /**
     * @return Collection<int, GroupLocation>
     */
    public function getGroupLocations(): Collection
    {
        return $this->groupLocations;
    }

    public function addGroupLocation(GroupLocation $groupLocation): static
    {
        if (!$this->groupLocations->contains($groupLocation)) {
            $this->groupLocations->add($groupLocation);
            $groupLocation->setOwnerGroup($this);
        }

        return $this;
    }

    public function removeGroupLocation(GroupLocation $groupLocation): static
    {
        if ($this->groupLocations->removeElement($groupLocation)) {
            // set the owning side to null (unless already changed)
            if ($groupLocation->getOwnerGroup() === $this) {
                $groupLocation->setOwnerGroup(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GroupSchedule>
     */
    public function getGroupSchedules(): Collection
    {
        return $this->groupSchedules;
    }

    public function addGroupSchedule(GroupSchedule $groupSchedule): static
    {
        if (!$this->groupSchedules->contains($groupSchedule)) {
            $this->groupSchedules->add($groupSchedule);
            $groupSchedule->setOwnerGroup($this);
        }

        return $this;
    }

    public function removeGroupSchedule(GroupSchedule $groupSchedule): static
    {
        if ($this->groupSchedules->removeElement($groupSchedule)) {
            // set the owning side to null (unless already changed)
            if ($groupSchedule->getOwnerGroup() === $this) {
                $groupSchedule->setOwnerGroup(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlannedTrip>
     */
    public function getPlannedTrips(): Collection
    {
        return $this->plannedTrips;
    }

    public function addPlannedTrip(PlannedTrip $plannedTrip): static
    {
        if (!$this->plannedTrips->contains($plannedTrip)) {
            $this->plannedTrips->add($plannedTrip);
            $plannedTrip->setOwnerGroup($this);
        }

        return $this;
    }

    public function removePlannedTrip(PlannedTrip $plannedTrip): static
    {
        if ($this->plannedTrips->removeElement($plannedTrip)) {
            // set the owning side to null (unless already changed)
            if ($plannedTrip->getOwnerGroup() === $this) {
                $plannedTrip->setOwnerGroup(null);
            }
        }

        return $this;
    }
}
