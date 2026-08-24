<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('landsing transaction')
                ->description('Assigned an asset to requester and set the expected return date.')
                ->schema([
                          Select::make('user_id')
                    ->required()
                    ->label('Requester')
                    ->relationship('user','name'),
                Select::make('asset_id')
                    ->required()
                    ->label('Asset name')
                    ->relationship('asset','name'),
                DatePicker::make('due_at'),
                ])->columns(3)
                ->columnSpanFull(),
            ]);
    }
}
