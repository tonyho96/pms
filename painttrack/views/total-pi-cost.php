<?php
foreach (Project::all() as $project) {
    foreach (Unit::all() as $unit) {
        if ($unit->getAttribute('U-P-ID') == $project->getAttribute('P-ID')) {
            foreach (Room::all() as $room) {
                if ($room->getAttribute('R-U-ID') == $unit->getAttribute('U-ID')) {
                    foreach (Item::all() as $item) {
                        if ($item->getAttribute('I-R-ID') == $room->getAttribute('R-ID')) {
                            foreach (Paint_infos::all() as $paint_info) {
                                if ($paint_info->getAttribute('PI-ID') == $item->getAttribute('I-PI-ID')) {
                                    $countp = $project->getAttribute('P-ID');
                                    $count[$countp][$paint_info->getAttribute('PI-ID')] = $paint_info->getAttribute('PI-Cost');
                                    $countu = $unit->getAttribute('U-ID');
                                    $count1[$countu][$paint_info->getAttribute('PI-ID')] = $paint_info->getAttribute('PI-Cost');
                                    $countr = $room->getAttribute('R-ID');
                                    $count1[$countr][$paint_info->getAttribute('PI-ID')] = $paint_info->getAttribute('PI-Cost');
                                    $total[$countp] = 0;
                                    foreach ($count[$countp] as $value) {
                                        $total[$countp] = $total[$countp] + $value;
                                    }
                                    $total1[$countu] = 0;
                                    foreach ($count1[$countu] as $value) {
                                        $total1[$countu] = $total1[$countu] + $value;
                                    }
                                    $total2[$countr] = 0;
                                    foreach ($count1[$countr] as $value) {
                                        $total2[$countr] = $total2[$countr] + $value;
                                    }

                                }
                            }
                        }
                    }
                }
            }
        }
    }
}