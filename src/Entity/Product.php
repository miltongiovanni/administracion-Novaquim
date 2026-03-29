<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $meta_title = null;

    #[ORM\Column(type: 'text')]
    private ?string $meta_description = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $image_1 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $image_2 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $image_3 = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    private ?Category $category = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $slug = null;

    #[ORM\ManyToOne(targetEntity: Mercado::class, inversedBy: 'products')]
    private ?Mercado $mercado = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->meta_title;
    }

    public function setMetaTitle(string $meta_title): self
    {
        $this->meta_title = $meta_title;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->meta_description;
    }

    public function setMetaDescription(string $meta_description): self
    {
        $this->meta_description = $meta_description;

        return $this;
    }

    public function getImage1(): ?string
    {
        return $this->image_1;
    }

    public function setImage1(string $image_1): self
    {
        $this->image_1 = $image_1;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image_2;
    }

    public function setImage2(?string $image_2): self
    {
        $this->image_2 = $image_2;

        return $this;
    }

    public function getImage3(): ?string
    {
        return $this->image_3;
    }

    public function setImage3(?string $image_3): self
    {
        $this->image_3 = $image_3;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getMercado(): ?Mercado
    {
        return $this->mercado;
    }

    public function setMercado(?Mercado $mercado): self
    {
        $this->mercado = $mercado;

        return $this;
    }
}
