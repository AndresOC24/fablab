<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoluntarioResource\Pages;
use App\Filament\Resources\VoluntarioResource\RelationManagers;
use App\Models\Voluntario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;

class VoluntarioResource extends Resource
{
    protected static ?string $model = Voluntario::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\TextInput::make('nombre')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('apellido')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('ci')
                ->required()
                ->rules(function ($record) {
                    return [
                        Rule::unique('voluntarios', 'ci')->ignore($record?->id),
                    ];
                }),
            Forms\Components\DatePicker::make('fecha_nacimiento')
                ->required(),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->rules(function ($record) {
                    return [
                        Rule::unique('voluntarios', 'email')->ignore($record?->id),
                    ];
                }),
            Forms\Components\Select::make('estado')
                ->options([
                    1 => 'Activo',
                    0 => 'Inactivo',
                ])
                ->default(1)
                ->label('Estado')
                ->required(),
            Forms\Components\TextInput::make('telefono')
                ->maxLength(20),
            Forms\Components\TextInput::make('universidad')
                ->maxLength(255),
            Forms\Components\Textarea::make('extra')
                ->maxLength(1000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellido')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ci')
                ->label('CI')
                ->searchable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                    ->date()
                    ->label('Fecha de Nacimiento'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo Electrónico')
                    ->searchable(),
                Tables\Columns\TextColumn::make('estado')
                    ->label('Estado')
                    ->formatStateUsing(function ($state) {
                        return $state ? 'Activo' : 'Inactivo';
                    })
                    ->colors([
                        'success' => true, // Verde para activo
                        'danger' => false, // Rojo para inactivo
                    ]),
                Tables\Columns\TextColumn::make('telefono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('universidad')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }



    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVoluntarios::route('/'),
            'create' => Pages\CreateVoluntario::route('/create'),
            'edit' => Pages\EditVoluntario::route('/{record}/edit'),
        ];
    }
}
