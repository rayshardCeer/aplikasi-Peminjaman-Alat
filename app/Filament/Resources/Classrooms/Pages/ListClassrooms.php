<?php

namespace App\Filament\Resources\Classrooms\Pages;

use App\Filament\Resources\Classrooms\ClassroomResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Schemas\Components\Tabs\Tab;

class ListClassrooms extends ListRecords
{
    protected static string $resource = ClassroomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array{

    return[
        'all' => Tab::make(),
        'grade 10' => Tab::make()
        ->modifyQueryUsing(fn (Builder $query) => $query->where('level',10)),
        'grade 11' => Tab::make()
        ->modifyQueryUsing(fn (Builder $query) => $query->where('level',11)),
        'grade 12' => Tab::make()
        ->modifyQueryUsing(fn (Builder $query) => $query->where('level',12)), 
    ];
    }
}
