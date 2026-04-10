import React, { useEffect, useState, useCallback } from 'react';
import ReactFlow, {
    Background,
    Controls,
    MiniMap,
    MarkerType,
    Panel,
    applyNodeChanges,
    applyEdgeChanges
} from 'reactflow';
import 'reactflow/dist/style.css';

export default function SchemaVisualizer() {
    const [nodes, setNodes] = useState([]);
    const [edges, setEdges] = useState([]);
    const [summary, setSummary] = useState(null);
    const [loading, setLoading] = useState(true);

    // Load saved layout from localStorage
    const loadSavedLayout = useCallback(() => {
        try {
            const saved = localStorage.getItem('db-schema-layout');
            return saved ? JSON.parse(saved) : null;
        } catch (error) {
            console.error('Error loading saved layout:', error);
            return null;
        }
    }, []);

    // Save layout to localStorage
    const saveLayout = useCallback((nodes) => {
        try {
            const layout = {};
            nodes.forEach(node => {
                layout[node.id] = node.position;
            });
            localStorage.setItem('db-schema-layout', JSON.stringify(layout));
        } catch (error) {
            console.error('Error saving layout:', error);
        }
    }, []);

    const onNodesChange = useCallback(
        (changes) => {
            setNodes((nds) => {
                const updatedNodes = applyNodeChanges(changes, nds);
                // Save layout when nodes are moved (dragStop)
                const hasDragStop = changes.some(change => change.type === 'position' && change.dragging === false);
                if (hasDragStop) {
                    saveLayout(updatedNodes);
                }
                return updatedNodes;
            });
        },
        [saveLayout]
    );

    const onEdgesChange = useCallback(
        (changes) => setEdges((eds) => applyEdgeChanges(changes, eds)),
        []
    );

    useEffect(() => {
        fetch('/api/schema')
            .then((res) => res.json())
            .then((response) => {
                const { tables, relationships, summary } = response;
                const newNodes = [];
                const newEdges = [];

                // Load saved layout
                const savedLayout = loadSavedLayout();

                // Separate entity tables and pivot tables
                const entityTables = tables.filter(t => !t.is_pivot);
                const pivotTables = tables.filter(t => t.is_pivot);

                // Create nodes for entity tables (main tables in top/middle area)
                entityTables.forEach((table, i) => {
                    const fkColumns = table.foreign_keys.map(fk => fk.column_name);

                    // Create HTML label with table details
                    const columnsList = table.columns.map(col => {
                        const isPK = col.Key === 'PRI';
                        const isFK = col.Key === 'MUL' || fkColumns.includes(col.Field);
                        const icon = isPK ? '🔑' : isFK ? '🔗' : '•';
                        const color = isPK ? '#059669' : isFK ? '#dc2626' : '#64748b';
                        return `<div style="color: ${color}; font-size: 11px; padding: 2px 0;">${icon} ${col.Field}</div>`;
                    }).join('');

                    const labelHtml = `
                        <div style="font-weight: bold; font-size: 14px; margin-bottom: 8px; color: #2563eb;">
                            📦 ${table.table}
                        </div>
                        <div style="border-top: 1px solid #cbd5e1; padding-top: 4px;">
                            ${columnsList}
                        </div>
                    `;

                    // Use saved position if available, otherwise use default
                    const defaultPosition = {
                        x: (i % 3) * 350 + 50,
                        y: Math.floor(i / 3) * 250 + 50
                    };

                    newNodes.push({
                        id: table.table,
                        position: savedLayout && savedLayout[table.table] ? savedLayout[table.table] : defaultPosition,
                        data: {
                            label: (
                                <div dangerouslySetInnerHTML={{ __html: labelHtml }} />
                            )
                        },
                        style: {
                            border: '2px solid #2563eb',
                            borderRadius: 8,
                            padding: 12,
                            backgroundColor: '#f8fafc',
                            width: 220,
                            fontSize: 12
                        }
                    });
                });

                // Create nodes for pivot tables (positioned between related tables)
                pivotTables.forEach((table, i) => {
                    const fkColumns = table.foreign_keys.map(fk => fk.column_name);

                    const columnsList = table.columns.map(col => {
                        const isPK = col.Key === 'PRI';
                        const isFK = col.Key === 'MUL' || fkColumns.includes(col.Field);
                        const icon = isPK ? '🔑' : isFK ? '🔗' : '•';
                        const color = isPK ? '#059669' : isFK ? '#dc2626' : '#64748b';
                        return `<div style="color: ${color}; font-size: 11px; padding: 2px 0;">${icon} ${col.Field}</div>`;
                    }).join('');

                    const labelHtml = `
                        <div style="font-weight: bold; font-size: 14px; margin-bottom: 8px; color: #9333ea;">
                            🔗 ${table.table}
                        </div>
                        <div style="border-top: 1px solid #d8b4fe; padding-top: 4px;">
                            ${columnsList}
                        </div>
                    `;

                    // Use saved position if available, otherwise use default
                    const defaultPosition = {
                        x: 50 + (i % 2) * 350 + 350,
                        y: 350 + Math.floor(i / 2) * 250
                    };

                    newNodes.push({
                        id: table.table,
                        position: savedLayout && savedLayout[table.table] ? savedLayout[table.table] : defaultPosition,
                        data: {
                            label: (
                                <div dangerouslySetInnerHTML={{ __html: labelHtml }} />
                            )
                        },
                        style: {
                            border: '2px dashed #9333ea',
                            borderRadius: 8,
                            padding: 12,
                            backgroundColor: '#faf5ff',
                            width: 220,
                            fontSize: 12
                        }
                    });
                });

                // Create edges based on relationship types
                console.log('Processing relationships:', relationships);
                relationships.forEach((rel, idx) => {
                    console.log('Relationship:', rel.type, rel);
                    if (rel.type === 'many_to_many') {
                        // Many-to-Many: Two edges connecting via pivot table
                        newEdges.push({
                            id: `${rel.table1}-${rel.pivot_table}`,
                            source: rel.table1,
                            target: rel.pivot_table,
                            type: 'default',
                            animated: true,
                            style: {
                                stroke: '#9333ea',
                                strokeWidth: 3
                            },
                            markerEnd: {
                                type: MarkerType.ArrowClosed,
                                color: '#9333ea',
                                width: 20,
                                height: 20
                            },
                            label: 'M:M',
                            labelStyle: {
                                fill: '#9333ea',
                                fontWeight: 'bold',
                                fontSize: 12
                            },
                            labelBgStyle: { fill: '#faf5ff', fillOpacity: 0.8 }
                        });

                        newEdges.push({
                            id: `${rel.pivot_table}-${rel.table2}`,
                            source: rel.pivot_table,
                            target: rel.table2,
                            type: 'default',
                            animated: true,
                            style: {
                                stroke: '#9333ea',
                                strokeWidth: 3
                            },
                            markerEnd: {
                                type: MarkerType.ArrowClosed,
                                color: '#9333ea',
                                width: 20,
                                height: 20
                            },
                            label: 'M:M',
                            labelStyle: {
                                fill: '#9333ea',
                                fontWeight: 'bold',
                                fontSize: 12
                            },
                            labelBgStyle: { fill: '#faf5ff', fillOpacity: 0.8 }
                        });

                    } else if (rel.type === 'one_to_many') {
                        // One-to-Many: Single edge from parent to child
                        newEdges.push({
                            id: `${rel.from_table}-${rel.to_table}-${rel.foreign_key}`,
                            source: rel.from_table,
                            target: rel.to_table,
                            type: 'default',
                            animated: false,
                            style: {
                                stroke: '#2563eb',
                                strokeWidth: 3
                            },
                            markerEnd: {
                                type: MarkerType.ArrowClosed,
                                color: '#2563eb',
                                width: 20,
                                height: 20
                            },
                            label: '1:N',
                            labelStyle: {
                                fill: '#2563eb',
                                fontWeight: 'bold',
                                fontSize: 12
                            },
                            labelBgStyle: { fill: '#f8fafc', fillOpacity: 0.8 }
                        });

                    } else if (rel.type === 'self_referencing') {
                        // Self-referencing: curved edge back to same table
                        newEdges.push({
                            id: `${rel.from_table}-self-${idx}`,
                            source: rel.from_table,
                            target: rel.to_table,
                            type: 'default',
                            animated: false,
                            style: {
                                stroke: '#059669',
                                strokeWidth: 3
                            },
                            markerEnd: {
                                type: MarkerType.ArrowClosed,
                                color: '#059669',
                                width: 20,
                                height: 20
                            },
                            label: 'parent',
                            labelStyle: {
                                fill: '#059669',
                                fontWeight: 'bold',
                                fontSize: 12
                            },
                            labelBgStyle: { fill: '#f0fdf4', fillOpacity: 0.8 }
                        });
                    }
                });

                console.log('All edges created:', newEdges);
                console.log('Edge colors:', newEdges.map(e => ({ id: e.id, color: e.style?.stroke })));

                setNodes(newNodes);
                setEdges(newEdges);
                setSummary(summary);
                setLoading(false);
            })
            .catch((err) => {
                console.error('Error fetching schema:', err);
                setLoading(false);
            });
    }, [loadSavedLayout]);

    if (loading) {
        return (
            <div style={{
                width: '100%',
                height: '100vh',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                fontSize: 20,
                color: '#64748b'
            }}>
                Loading database schema...
            </div>
        );
    }

    return (
        <div style={{ width: '100%', height: '100vh' }}>
            <ReactFlow
                nodes={nodes}
                edges={edges}
                onNodesChange={onNodesChange}
                onEdgesChange={onEdgesChange}
                fitView
                minZoom={0.1}
                maxZoom={1.5}
                edgesUpdatable={false}
                edgesFocusable={false}
            >
                <Background />
                <Controls />
                <MiniMap
                    nodeColor={(node) => node.data.isPivot ? '#9333ea' : '#2563eb'}
                    maskColor="rgba(0, 0, 0, 0.1)"
                />

                <Panel position="top-left" style={{
                    backgroundColor: 'white',
                    padding: '16px',
                    borderRadius: '8px',
                    boxShadow: '0 4px 6px rgba(0,0,0,0.1)',
                    maxWidth: '300px'
                }}>
                    <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '12px' }}>
                        <h3 style={{ margin: 0, color: '#1e293b' }}>
                            Database Schema
                        </h3>
                        <button
                            onClick={() => {
                                if (confirm('Reset layout to default positions?')) {
                                    localStorage.removeItem('db-schema-layout');
                                    window.location.reload();
                                }
                            }}
                            style={{
                                padding: '4px 8px',
                                fontSize: '11px',
                                background: '#ef4444',
                                color: 'white',
                                border: 'none',
                                borderRadius: '4px',
                                cursor: 'pointer'
                            }}
                            title="Reset to default layout"
                        >
                            Reset
                        </button>
                    </div>
                    {summary && (
                        <div style={{ fontSize: 13, color: '#475569', lineHeight: 1.8 }}>
                            <div>📊 Total Tables: <strong>{summary.total_tables}</strong></div>
                            <div>📦 Entity Tables: <strong>{summary.entity_tables}</strong></div>
                            <div>🔗 Pivot Tables: <strong>{summary.pivot_tables}</strong></div>
                            <div>🔀 Relationships: <strong>{summary.total_relationships}</strong></div>
                        </div>
                    )}

                    <div style={{
                        marginTop: 16,
                        paddingTop: 16,
                        borderTop: '1px solid #e2e8f0',
                        fontSize: 12,
                        color: '#64748b'
                    }}>
                        <div style={{ marginBottom: 10, fontWeight: 'bold', color: '#1e293b' }}>Legend:</div>
                        <div style={{ display: 'flex', alignItems: 'center', gap: 8, marginBottom: 6 }}>
                            <div style={{
                                width: 35,
                                height: 3,
                                backgroundColor: '#2563eb'
                            }} />
                            <span><strong style={{ color: '#2563eb' }}>1:N</strong> One-to-Many</span>
                        </div>
                        <div style={{ display: 'flex', alignItems: 'center', gap: 8, marginBottom: 6 }}>
                            <div style={{
                                width: 35,
                                height: 3,
                                backgroundColor: '#9333ea'
                            }} />
                            <span><strong style={{ color: '#9333ea' }}>M:M</strong> Many-to-Many</span>
                        </div>
                        <div style={{ display: 'flex', alignItems: 'center', gap: 8, marginBottom: 10 }}>
                            <div style={{
                                width: 35,
                                height: 3,
                                backgroundColor: '#059669'
                            }} />
                            <span><strong style={{ color: '#059669' }}>↻</strong> Self-Reference</span>
                        </div>
                        <div style={{ fontSize: 11, color: '#94a3b8', lineHeight: 1.5 }}>
                            <div>🔑 Primary Key</div>
                            <div>🔗 Foreign Key</div>
                        </div>
                    </div>
                </Panel>
            </ReactFlow>
        </div>
    );
}
