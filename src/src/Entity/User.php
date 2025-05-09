<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Este email ya está registrado.')]
#[UniqueEntity(fields: ['phoneNumber'], message: 'Este número de teléfono ya está registrado.')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'El nombre es obligatorio.')]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'El nombre debe tener al menos {{ limit }} caracteres.',
        maxMessage: 'El nombre no puede exceder {{ limit }} caracteres.'
    )]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profilePicture = null;

    /**
     * @var Collection<int, Vehicle>
     */
    #[ORM\OneToMany(targetEntity: Vehicle::class, mappedBy: 'owner')]
    private Collection $vehicles;

    /**
     * @var Collection<int, Group>
     */
    #[ORM\OneToMany(targetEntity: Group::class, mappedBy: 'groupAdmin')]
    private Collection $managedGroups;

    /**
     * @var Collection<int, Group>
     */
    #[ORM\ManyToMany(targetEntity: Group::class, mappedBy: 'participants')]
    private Collection $userGroups;

    /**
     * @var Collection<int, PersonalLocation>
     */
    #[ORM\OneToMany(targetEntity: PersonalLocation::class, mappedBy: 'user')]
    private Collection $personalLocations;

    /**
     * @var Collection<int, PersonalSchedule>
     */
    #[ORM\OneToMany(targetEntity: PersonalSchedule::class, mappedBy: 'user')]
    private Collection $personalSchedules;

    /**
     * @var Collection<int, NonAvailableTime>
     */
    #[ORM\OneToMany(targetEntity: NonAvailableTime::class, mappedBy: 'user')]
    private Collection $nonAvailableTimes;

    /**
     * @var Collection<int, PlannedTrip>
     */
    #[ORM\OneToMany(targetEntity: PlannedTrip::class, mappedBy: 'driver')]
    private Collection $driverPlannedTrips;

    /**
     * @var Collection<int, PlannedTrip>
     */
    #[ORM\ManyToMany(targetEntity: PlannedTrip::class, mappedBy: 'passengers')]
    private Collection $passengerPlannedTrips;

    public function __construct()
    {
        $this->vehicles = new ArrayCollection();
        $this->managedGroups = new ArrayCollection();
        $this->userGroups = new ArrayCollection();
        $this->personalLocations = new ArrayCollection();
        $this->personalSchedules = new ArrayCollection();
        $this->nonAvailableTimes = new ArrayCollection();
        $this->driverPlannedTrips = new ArrayCollection();
        $this->passengerPlannedTrips = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): static
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    /**
     * @return Collection<int, Vehicle>
     */
    public function getVehicles(): Collection
    {
        return $this->vehicles;
    }

    public function addVehicle(Vehicle $vehicle): static
    {
        if (!$this->vehicles->contains($vehicle)) {
            $this->vehicles->add($vehicle);
            $vehicle->setOwner($this);
        }

        return $this;
    }

    public function removeVehicle(Vehicle $vehicle): static
    {
        if ($this->vehicles->removeElement($vehicle)) {
            // set the owning side to null (unless already changed)
            if ($vehicle->getOwner() === $this) {
                $vehicle->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Group>
     */
    public function getManagedGroups(): Collection
    {
        return $this->managedGroups;
    }

    public function addManagedGroup(Group $managedGroup): static
    {
        if (!$this->managedGroups->contains($managedGroup)) {
            $this->managedGroups->add($managedGroup);
            $managedGroup->setGroupAdmin($this);
        }

        return $this;
    }

    public function removeManagedGroup(Group $managedGroup): static
    {
        if ($this->managedGroups->removeElement($managedGroup)) {
            // set the owning side to null (unless already changed)
            if ($managedGroup->getGroupAdmin() === $this) {
                $managedGroup->setGroupAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Group>
     */
    public function getUserGroups(): Collection
    {
        return $this->userGroups;
    }

    public function addUserGroup(Group $userGroup): static
    {
        if (!$this->userGroups->contains($userGroup)) {
            $this->userGroups->add($userGroup);
            $userGroup->addParticipant($this);
        }

        return $this;
    }

    public function removeUserGroup(Group $userGroup): static
    {
        if ($this->userGroups->removeElement($userGroup)) {
            $userGroup->removeParticipant($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, PersonalLocation>
     */
    public function getPersonalLocations(): Collection
    {
        return $this->personalLocations;
    }

    public function addPersonalLocation(PersonalLocation $personalLocation): static
    {
        if (!$this->personalLocations->contains($personalLocation)) {
            $this->personalLocations->add($personalLocation);
            $personalLocation->setUser($this);
        }

        return $this;
    }

    public function removePersonalLocation(PersonalLocation $personalLocation): static
    {
        if ($this->personalLocations->removeElement($personalLocation)) {
            // set the owning side to null (unless already changed)
            if ($personalLocation->getUser() === $this) {
                $personalLocation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PersonalSchedule>
     */
    public function getPersonalSchedules(): Collection
    {
        return $this->personalSchedules;
    }

    public function addPersonalSchedule(PersonalSchedule $personalSchedule): static
    {
        if (!$this->personalSchedules->contains($personalSchedule)) {
            $this->personalSchedules->add($personalSchedule);
            $personalSchedule->setUser($this);
        }

        return $this;
    }

    public function removePersonalSchedule(PersonalSchedule $personalSchedule): static
    {
        if ($this->personalSchedules->removeElement($personalSchedule)) {
            // set the owning side to null (unless already changed)
            if ($personalSchedule->getUser() === $this) {
                $personalSchedule->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, NonAvailableTime>
     */
    public function getNonAvailableTimes(): Collection
    {
        return $this->nonAvailableTimes;
    }

    public function addNonAvailableTime(NonAvailableTime $nonAvailableTime): static
    {
        if (!$this->nonAvailableTimes->contains($nonAvailableTime)) {
            $this->nonAvailableTimes->add($nonAvailableTime);
            $nonAvailableTime->setUser($this);
        }

        return $this;
    }

    public function removeNonAvailableTime(NonAvailableTime $nonAvailableTime): static
    {
        if ($this->nonAvailableTimes->removeElement($nonAvailableTime)) {
            // set the owning side to null (unless already changed)
            if ($nonAvailableTime->getUser() === $this) {
                $nonAvailableTime->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlannedTrip>
     */
    public function getDriverPlannedTrips(): Collection
    {
        return $this->driverPlannedTrips;
    }

    public function addDriverPlannedTrip(PlannedTrip $driverPlannedTrip): static
    {
        if (!$this->driverPlannedTrips->contains($driverPlannedTrip)) {
            $this->driverPlannedTrips->add($driverPlannedTrip);
            $driverPlannedTrip->setDriver($this);
        }

        return $this;
    }

    public function removeDriverPlannedTrip(PlannedTrip $driverPlannedTrip): static
    {
        if ($this->driverPlannedTrips->removeElement($driverPlannedTrip)) {
            // set the owning side to null (unless already changed)
            if ($driverPlannedTrip->getDriver() === $this) {
                $driverPlannedTrip->setDriver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlannedTrip>
     */
    public function getPassengerPlannedTrips(): Collection
    {
        return $this->passengerPlannedTrips;
    }

    public function addPassengerPlannedTrip(PlannedTrip $passengerPlannedTrip): static
    {
        if (!$this->passengerPlannedTrips->contains($passengerPlannedTrip)) {
            $this->passengerPlannedTrips->add($passengerPlannedTrip);
            $passengerPlannedTrip->addPassenger($this);
        }

        return $this;
    }

    public function removePassengerPlannedTrip(PlannedTrip $passengerPlannedTrip): static
    {
        if ($this->passengerPlannedTrips->removeElement($passengerPlannedTrip)) {
            $passengerPlannedTrip->removePassenger($this);
        }

        return $this;
    }
}
