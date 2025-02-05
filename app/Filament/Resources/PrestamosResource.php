<?php

namespace App\Filament\Resources;


use App\Filament\Resources\PrestamosResource\Pages;
use App\Filament\Resources\PrestamosResource\RelationManagers;
use App\Models\Material;
use App\Models\Prestamo;
use App\Models\Voluntario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrestamosResource extends Resource
{
    protected static ?string $model = Prestamo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('voluntarios_id')
                ->required()
                ->label('Voluntario')
                ->options(Voluntario::query()->pluck('nombre', 'id')) // Carga las áreas de la base de datos
                ->searchable(),
                Forms\Components\Select::make('material_id')
                ->required()
                ->label('Material')
                ->options(Material::query()->pluck('nombre', 'id'))
                // ->relationship('material', 'nombre') // Relación con voluntarios
                // ->multiple()
                ->searchable(),
                Forms\Components\TextInput::make('cantidad')
                ->required()
                ->label('Cantidad')
                ->numeric(),
                Forms\Components\DatePicker::make('fecha_prestamo')
                ->required()
                ->label('Fecha prestamo'),
                Forms\Components\DatePicker::make('fecha_devolucion')
                ->required()
                ->label('Fecha devolución'),
                Forms\Components\Select::make('estado')
                ->options([
                    1 => 'Prestado',
                    0 => 'Devuelto',
                ])
                ->default(1)
                ->required(),
                Forms\Components\TextInput::make('observaciones')
                ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Mostrar el nombre del voluntario
                Tables\Columns\TextColumn::make('voluntario.nombre') // Relación con voluntario
                    ->label('Voluntario')
                    ->alignCenter()
                    ->searchable(),

                // Mostrar el nombre del material
                Tables\Columns\TextColumn::make('material.nombre') // Relación con material
                    ->label('Material')
                    ->alignCenter()
                    ->searchable(),

                // Mostrar cantidad
                Tables\Columns\TextColumn::make('cantidad')
                    ->label('Cantidad')
                    ->alignCenter()
                    ->sortable(),

                // Mostrar la fecha de préstamo
                Tables\Columns\TextColumn::make('fecha_prestamo')
                    ->label('Fecha Préstamo')
                    ->alignCenter()
                    ->date()
                    ->sortable(),

                // Mostrar la fecha de devolución
                Tables\Columns\TextColumn::make('fecha_devolucion')
                    ->label('Fecha Devolución')
                    ->alignCenter()
                    ->date()
                    ->sortable(),

                // Mostrar estado como texto legible
                Tables\Columns\TextColumn::make('estado')
                    ->label('Estado')
                    ->alignCenter()
                    ->badge()
                    ->color(fn (string $state): string => $state === '1' ? 'success' : 'danger')
                    ->formatStateUsing(fn (string $state): string => $state === '1' ? 'Prestado' : 'Devuelto')
                    ->sortable(),

                // Mostrar observaciones
                Tables\Columns\TextColumn::make('observaciones')
                    ->label('Observaciones')
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListPrestamos::route('/'),
            'create' => Pages\CreatePrestamos::route('/create'),
            'edit' => Pages\EditPrestamos::route('/{record}/edit'),
        ];
    }
}
