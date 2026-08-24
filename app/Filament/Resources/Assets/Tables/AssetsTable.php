<?php

namespace App\Filament\Resources\Assets\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class AssetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ColumnGroup::make('asset details',[
                    
                ImageColumn::make('image')
                ->disk('public')
                ->imageSize(50),
                TextColumn::make('name')
                ->label('name')
                ->searchable(),
                TextColumn::make('code')
                ->searchable(),
     
                TextColumn::make('category.name')
                    ->label('category')
                    ->sortable()
                     ->toggleable(isToggledHiddenByDefault: true), 
              
                ]),

                ColumnGroup::make('Asset Condition / Stock',[
                  TextColumn::make('good_qty')
                    ->label('good')
                    ->numeric(),
                TextColumn::make('damaged_qty')
                ->label('damaged')
                    ->numeric(),
                TextColumn::make('borrowed_qty')
                ->label('borrowed')
                    ->numeric(),
                TextColumn::make('lost_qty')
                ->label('lost')
                ->numeric(),  
                TextColumn::make('total_qty')
               ->numeric()
               ->label('total'),  
                    TextColumn::make('available_qty')
                    ->label('available')
                    ->numeric()
                    ->getStateUsing(fn($record)=>$record->good_qty - $record->borrowed_qty)
                    ->badge(),
                ]),

                IconColumn::make('is_available')
                ->label('available')
                    ->boolean()
                     ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category_id')
                ->label('category')
                ->relationship('category','name'),
                TernaryFilter::make('is_available')
                ->label('availability')
            ])
            ->recordActions([
                ActionGroup::make([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
