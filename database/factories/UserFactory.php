<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'cpf' => fake()->unique()->randomNumber(),
            'profile_picture' => fake()->imageUrl(),
            'attendance' => now(),
            'address' => fake()->streetAddress(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }

    // public function testGetResponsesShouldFilterByStatus(): void
    // {
    //     $company = factory(Company::class)->create();

    //     $authData = new AuthenticationDTO(
    //         $company->user_id,
    //         $company->user_id,
    //         $company->id,
    //         $company->id
    //     );
    //     $this->setUpMocksAuthentication($authData);

    //     $admission = factory(Admission::class)->create([
    //         'company_id' => $company->id
    //     ]);
    //     dd($company);
    //     factory(AdmissionCandidate::class, 5)->create([
    //         'admission_id' => $admission->id,
    //         'status_id' => AdmissionCandidateStatusEnum::APPROVED
    //     ]);

    //     factory(AdmissionCandidate::class, 3)->create([
    //         'admission_id' => $admission->id,
    //         'status_id' => AdmissionCandidateStatusEnum::PENDING
    //     ]);

    //     $response = $this->getJson('/api/admission/candidates?archived=false&status=22913699');

    //     $response->assertStatus(200)
    //         ->assertJson([
    //             'message' => 'Ok.',
    //             'error' => false
    //         ])
    //         ->assertJsonCount(5, 'data');
    // }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
