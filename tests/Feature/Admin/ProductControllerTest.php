<?php
namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $this->category = Category::factory()->create();
    }

    public function test_admin_can_view_product_list()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.products.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.products.index');
    }

    public function test_admin_can_create_product()
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin)
            ->post(route('admin.products.store'), [
                'name' => 'Test Product',
                'category_id' => $this->category->id,
                'price' => 100000,
                'description' => 'Test Description',
                'image' => UploadedFile::fake()->image('product.jpg'),
                'stock' => 10,
                'status' => 'active'
            ]);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product'
        ]);
    }
}