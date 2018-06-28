<?php extract($displayData); ?>
<div ng-cloak class="px-4" id="layoutController" ng-controller="layoutController">
   <textarea class="d-none" name="<?php echo $name; ?>">{{ layout}}</textarea>
   <!--<div style="margin-right: -1rem;" class="text-right mb-4">
      <button type="button" ng-click="exportLayout()" class="btn btn-secondary btn-sm mr-2"><i class="fa fa-download"></i> Export</button>
      <button type="button" ng-click="importLayout()" class="btn btn-light btn-sm"><i class="fa fa-upload"></i> Import</button>
      <input type="file" onchange="uploadLayoutJSON()" accept=".json" id="astroid-layout-import" class="d-none" />
   </div>-->
   <div class="ezlb-pop" ng-class="{'open': chooseRow.open}">
      <div class="ezlb-pop-overlay"></div>
      <div class="ezlb-pop-body">
         <div class="ezlb-pop-header">
            <span class="title">SELECT A GRID LAYOUT</span>
            <span class="dismiss" ng-click="chooseRow.open = 0; chooseRow.section = null;"><i class="fa fa-times"></i></span>
         </div>
         <div class="ezlb-grid-items">
            <div class="row m-0">
               <div ng-click="addRow(chooseRow.section, grid);" ng-repeat="grid in grids track by $index" class="col-3 ezlb-grid-item">
                  <div class="row m-0 p-0">
                     <div ng-repeat="gridsize in grid track by $index" class="ezlb-grid-item-col col-{{ gridsize}}"><span>{{ gridsize}}</span></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="ezlb-pop" ng-class="{'open': chooseRowColumns.open}">
      <div class="ezlb-pop-overlay"></div>
      <div class="ezlb-pop-body">
         <div class="ezlb-pop-header">
            <span class="title">SELECT A GRID LAYOUT</span>
            <span class="dismiss" ng-click="chooseRowColumns.open = 0; chooseRowColumns.section = null; chooseRowColumns.row = null;"><i class="fa fa-times"></i></span>
         </div>
         <div class="ezlb-grid-items">
            <div class="row m-0">
               <div ng-click="updateRow(chooseRowColumns.row, chooseRowColumns.section, grid);" ng-repeat="grid in grids track by $index" class="col-3 ezlb-grid-item">
                  <div class="row m-0 p-0">
                     <div ng-repeat="gridsize in grid track by $index" class="ezlb-grid-item-col col-{{ gridsize}}"><span>{{ gridsize}}</span></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="ezlb-pop" ng-class="{'open': chooseElement.open}">
      <div class="ezlb-pop-overlay"></div>
      <div class="ezlb-pop-body">
         <div class="ezlb-pop-header">
            <span class="title">SELECT AN ELEMENT</span>
            <span class="dismiss" ng-click="chooseElement.open = 0; chooseElement.row = null; chooseElement.column = null; chooseElement.section = null; chooseElement.element = null;"><i class="fa fa-times"></i></span>
            <span class="compress"><i class="fa fa-compress"></i></span>
            <span class="expand"><i class="fa fa-expand"></i></span>
         </div>
         <div class="ezlb-grid-items">
            <div class="row m-0">
               <div ng-show="canAddElement(element)" ng-click="addElement(chooseElement.column, chooseElement.row, chooseElement.section, chooseElement.element, element);" ng-repeat="element in elements track by $index" class="col-3 ezlb-grid-item">
                  <div class="row m-0 p-0">
                     <div class="ezlb-grid-item-element col-12"><span><span class="title"><i class="{{ element.icon}}"></i> {{ element.title}}</span><span class="sub-title">{{ element.description}}</span></span></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="ezlb-pop">
      <div class="ezlb-pop-overlay"></div>
      <div class="ezlb-pop-body">
         <div class="ezlb-pop-header">
            <span class="title">OPTIONS</span>
            <span class="dismiss" ng-click="chooseRowColumns.open = 0; chooseRowColumns.section = null; chooseRowColumns.row = null;"><i class="fa fa-times"></i></span>
            <span class="compress"><i class="fa fa-compress"></i></span>
            <span class="expand"><i class="fa fa-expand"></i></span>
         </div>
         <div class="ezlb-grid-items">
            <div class="row">
               <div class="col px-5">
                  <form id="EZElementModulePositionForm">
                     <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" class="form-control" />
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div ng-sortable="{draggable: '.ezlb-section',animation: 100,handle:'.ezlb-section-handle'}" class="ezlb">
      <div ng-repeat="section in layout.sections track by $index" class="ezlb-section row my-3" ng-init="sectionIndex = $index">
         <span class="ezlb-title"><input type="text" autocomplete="off" ng-show="false" /><span ng-click="editElement(section, 'title')" data-astroid-tooltip="Click to edit Title">{{ getParam(section, 'title')}}</span></span>
         <span class="ezlb-toolbar">
            <span class="ezlb-action ezlb-section-handle"><i class="fa fa-arrows-alt"></i></span>
            <span class="ezlb-action" ng-click="editElement(section)"><i class="fa fa-pencil-alt"></i></span>
            <span class="ezlb-action" ng-click="duplicateSection(sectionIndex)"><i class="fa fa-copy"></i></span>
            <span class="ezlb-action text-danger" ng-show="layout.sections.length > 1" ng-click="removeSection(sectionIndex);"><i class="fa fa-trash"></i></span>
            <span class="ezlb-action" ng-click="addingRow(sectionIndex)"><i class="fa fa-align-left"></i> New Row</span>
            <span class="ezlb-action" ng-click="addSection(sectionIndex)"><i class="fa fa-plus"></i> New Section</span>
         </span>
         <div class="col-12 ezlb-content" ng-sortable="{draggable:'.ezlb-row', animation: 100, handle: '.ezlb-row-handle'}">
            <div ng-repeat="row in section.rows track by $index" class="ezlb-row row ezlb-row-{{ sectionIndex}}-{{ rowIndex}}" ng-init="rowIndex = $index">
               <span class="ezlb-toolbar">
                  <span class="ezlb-action" ng-click="editRow(rowIndex, sectionIndex)"><i class="fa fa-columns"></i></span>
                  <span ng-click="duplicateRow(rowIndex, sectionIndex)" class="ezlb-action"><i class="fa fa-copy"></i></span>
                  <span ng-show="section.rows.length > 1" ng-click="removeRow(rowIndex, sectionIndex)" class="ezlb-action text-danger"><i class="fa fa-trash"></i></span>
               </span>
               <span class="ezlb-toolbar toolbar-left">
                  <span class="ezlb-action ezlb-row-handle" ng-show="section.rows.length > 1"><i class="fa fa-arrows-alt"></i></span>
               </span>
               <div class="col-12">
                  <div class="row" ng-sortable="{draggable: '.ezlb-col',animation: 100}">
                     <div ng-repeat="column in row.cols track by $index" class="ezlb-col col-{{ column.size}} ezlb-col-{{ sectionIndex}}-{{ rowIndex}}-{{ columnIndex}} {{ column.elements.length == 0 ? 'ezlb-col-empty' : '' }}" ng-init="columnIndex = $index">
                        <div ng-if="column.elements.length != 0" class="ezlb-col-overlay"></div>
                        <div ng-if="column.elements.length == 0" ng-click="addingElement(columnIndex, rowIndex, sectionIndex, null)" class="ezlb-add-element">
                        </div>

                        <div ng-if="column.elements.length != 0" ng-click="addingElement(columnIndex, rowIndex, sectionIndex, null)" class="ezlb-add-element">
                        </div>
                        <div ng-show="column.elements.length != 0" class="ezlb-elements" ng-sortable="{draggable: '.ezlb-element',animation: 100, 'handle': '.ezlb-element-handle'}">
                           <div ng-repeat="element in column.elements track by $index" ng-init="elementIndex = $index" class="ezlb-element">

                              <span class="ezlb-toolbar">
                                 <span class="ezlb-action" ng-click="editElement(element)"><i class="fa fa-pencil-alt"></i></span>
                                 <span class="ezlb-action" ng-show="canAddElement(getElementByType(element.type))" ng-click="duplicateElement(elementIndex, columnIndex, rowIndex, sectionIndex)"><i class="fa fa-copy"></i></span>
                                 <span ng-show="column.elements.length > 1" class="ezlb-action ezlb-element-handle"><i class="fa fa-arrows-alt"></i></span>
                                 <span class="ezlb-action text-danger" ng-click="removeElement(elementIndex, columnIndex, rowIndex, sectionIndex);"><i class="fa fa-trash"></i></span>
                              </span>

                              <span class="element-title"><i class="{{ getElementByType(element.type).icon}}"></i> {{ getParam(element, 'title')}}</span>
                              <span ng-click="addingElement(columnIndex, rowIndex, sectionIndex, elementIndex)" class="ezlb-add-element"><i class="fa fa-plus"></i></span>
                           </div>
                        </div>
                     </div> 
                  </div> 
               </div> 
            </div>
         </div>
         <div class="clearfix"></div>
         <hr class="w-100"/>
      </div>
   </div>
   <br/>
   <div class="text-center mb-4">
      <span ng-click="addSection(null)" class="d-inline ezlb-btn"><i class="fa fa-plus"></i> Add Section</span>
   </div>
   <br/>
</div>
<script>
   var _layout = <?php echo json_encode($options); ?>;
   var AstroidLayoutBuilderElements = [];
<?php
$astroidElements = AstroidFrameworkHelper::getAllAstroidElements();

foreach ($astroidElements as $astroidElement) {
   echo 'AstroidLayoutBuilderElements.push(' . json_encode($astroidElement->getInfo()) . ');';
}
?>
</script>
<?php foreach ($astroidElements as $astroidElement) { ?>
   <script type="text/ng-template" id="element-form-template-<?php echo $astroidElement->type; ?>">
   <?php echo $astroidElement->renderForm(); ?>
   </script>
<?php } ?>

<?php $sectionElement = new AstroidElement('section'); ?>
<script type="text/ng-template" id="element-form-template-section">
   <?php echo $sectionElement->renderForm(); ?>
</script>