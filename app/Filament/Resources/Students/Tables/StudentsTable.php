<?php

namespace App\Filament\Resources\Students\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
              ->contentGrid([
                'xl' => 4,
                'lg' => 3,
                'md' => 3,
            ])
            ->columns([
                Grid::make([
                    'default' => 1
                ])->schema([
                   ImageColumn::make('profile_picture')
                    ->disk('public')
                    ->imageSize(200)
                    ->imageHeight(70)
                    ->alignCenter(),
                      Stack::make([
                TextColumn::make('user.name')
                    ->label('Student Name')
                    ->numeric()
                    ->weight('bold')
                    ->sortable(),
                TextColumn::make('nisn')
                    ->label('NISN')
                    ->icon(Heroicon::Identification)
                    ->searchable(),
                TextColumn::make('classroom.name')
                    ->label('Class')
                    ->numeric()
                    ->icon(Heroicon::BuildingOffice)
                    ->sortable(),
                TextColumn::make('phone_number')
                ->label('Phone Number')
                ->icon(Heroicon::Phone)
                    ->searchable(),
                TextColumn::make('gender')
                ->label('Gender')
                    ->badge(),
                  ]),
                ]),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
