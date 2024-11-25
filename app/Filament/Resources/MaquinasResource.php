<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaquinasResource\Pages;
use App\Filament\Resources\MaquinasResource\RelationManagers;
use App\Models\Area;
use App\Models\Maquina;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;

class MaquinasResource extends Resource
{
    protected static ?string $model = Maquina::class;

    protected static ?string $navigationIcon = 'heroicon-s-rectangle-group';

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
                Forms\Components\TextInput::make('numero_serie')
                    ->maxLength(255),
                Forms\Components\Select::make('id_areas')
                    ->label('Área')
                    ->options(\App\Models\Area::query()->pluck('nombre', 'id')) // Referencia al modelo correcto
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('observaciones')
                    ->maxLength(255)
                    ->default('Ninguno'),
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('modelo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero_serie')
                    ->searchable(),
                Tables\Columns\TextColumn::make('area.nombre') // Mostrar el nombre del área
                    ->label('Área')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('imagen')
                    ->circular()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('observaciones')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListMaquinas::route('/'),
            'create' => Pages\CreateMaquinas::route('/create'),
            'edit' => Pages\EditMaquinas::route('/{record}/edit'),
        ];
    }
}
