<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialResource\Pages;
use App\Filament\Resources\MaterialResource\RelationManagers;
use App\Models\Area;
use App\Models\Material;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;

    public static function getPluralLabel(): string
    {
        return 'Materiales';
    }

    protected static ?string $navigationIcon = 'heroicon-m-archive-box-arrow-down';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('modelo')
                    ->maxLength(255),
                Forms\Components\Select::make('estado')
                                    ->options([
                    'Disponible' => 'Disponible',
                    'Agotado' => 'Agotado',
                ])
                ->required() // Hace que este campo sea obligatorio
                ->default('Disponible') // Opción por defecto
                ->label('Estado'),
                Forms\Components\TextInput::make('observaciones')
                    ->required()
                    ->maxLength(255)
                    ->default('Ninguno'),
                Forms\Components\TextInput::make('costo_adquisicion')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('id_areas') // Campo para seleccionar el área
                    ->label('Área')
                    ->options(Area::query()->pluck('nombre', 'id')) // Carga las áreas de la base de datos
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('cantidad')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\FileUpload::make('imagen')
                    ->image()
                    ->directory('images')
                    ->imageEditor(),
                Forms\Components\Textarea::make('descripcion')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('modelo')
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('estado')
                    ->alignCenter()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Disponible' => 'success',
                        'Agotado' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('costo_adquisicion')
                    ->alignCenter()
                    ->numeric()
                    ->wrapHeader()
                    ->label('Costo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('cantidad')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('imagen')
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->circular(),
                Tables\Columns\TextColumn::make('observaciones')
                    ->alignCenter()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('area.nombre') // Mostrar el nombre del área
                    ->alignCenter()
                    ->label('Área')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->alignCenter()
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->alignCenter()
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListMaterials::route('/'),
            'create' => Pages\CreateMaterial::route('/create'),
            'edit' => Pages\EditMaterial::route('/{record}/edit'),
        ];
    }
}
